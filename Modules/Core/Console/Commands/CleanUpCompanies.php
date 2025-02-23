<?php

namespace Modules\Core\Console\Commands;

use Illuminate\Console\Command;
use Modules\Core\Models\Company;

class CleanUpCompanies extends Command
{
    protected $signature = 'cleanup:companies';

    protected $description = 'Deletes companies with no related records and lists the top companies with the most accounts and leads.';

    public function handle(): void
    {
        $this->info('🔍 Finding unused companies...');

        $companiesWithData = Company::whereHas('accounts')
            ->orWhereHas('projects')
            ->orWhereHas('contacts')
            ->orWhereHas('leads')
            ->orWhereHas('users')
            ->pluck('id')
            ->toArray();

        $unusedCompanies = Company::whereNotIn('id', $companiesWithData)->get();

        if ($unusedCompanies->isEmpty()) {
            $this->info('✅ No empty companies found.');
        } else {
            $this->info('❌ Deleting ' . $unusedCompanies->count() . ' empty companies...');
            Company::whereNotIn('id', $companiesWithData)->delete();
            $this->info('✅ Unused companies deleted.');
        }

        $this->info("\n📊 Finding companies with the most accounts and leads...");

        $topCompanies = Company::withCount(['accounts', 'leads'])
            ->orderByDesc('accounts_count')
            ->orderByDesc('leads_count')
            ->limit(10)
            ->get(['id', 'name', 'accounts_count', 'leads_count']);

        if ($topCompanies->isEmpty()) {
            $this->info('No companies found.');
        } else {
            $this->table(
                ['Company ID', 'Company Name', 'Accounts', 'Leads'],
                $topCompanies->map(fn ($company) => [
                    $company->id,
                    $company->name,
                    $company->accounts_count,
                    $company->leads_count,
                ])->toArray()
            );
        }

        $this->info("\n✅ Cleanup and analysis completed!");
    }
}
