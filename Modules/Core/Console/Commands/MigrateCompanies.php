<?php

namespace Modules\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Modules\Core\Models\Company;

class MigrateCompanies extends Command
{
    protected $signature = 'cleanup:migrate-companies';

    protected $description = 'Migrate records from non-top companies to a random top company and delete the source companies';

    public function handle(): void
    {
        $this->info('🔍 Finding top companies...');

        // Get top 10 companies ordered by accounts and leads counts.
        $topCompanies = Company::withCount(['accounts', 'leads'])
            ->orderByDesc('accounts_count')
            ->orderByDesc('leads_count')
            ->limit(10)
            ->get();

        if ($topCompanies->isEmpty()) {
            $this->error('No top companies found.');

            return;
        }

        $topCompanyIds = $topCompanies->pluck('id')->toArray();
        $this->info('Top Companies: ' . implode(', ', $topCompanyIds));

        $companiesToMigrate = Company::whereNotIn('id', $topCompanyIds)->get();

        if ($companiesToMigrate->isEmpty()) {
            $this->info('✅ No companies to migrate.');

            return;
        }

        $this->info('Migrating ' . $companiesToMigrate->count() . ' companies...');

        DB::transaction(function () use ($companiesToMigrate, $topCompanyIds): void {
            foreach ($companiesToMigrate as $company) {
                $targetCompanyId = $topCompanyIds[array_rand($topCompanyIds)];
                $this->info("Migrating Company [{$company->id}] -> Target Company [{$targetCompanyId}]");

                $company->accounts()->update(['company_id' => $targetCompanyId]);
                $company->leads()->update(['company_id' => $targetCompanyId]);
                $company->contacts()->update(['company_id' => $targetCompanyId]);
                $company->projects()->update(['company_id' => $targetCompanyId]);

                $pivotRows = DB::table('company_users')
                    ->where('company_id', $company->id)
                    ->get();

                foreach ($pivotRows as $row) {
                    $userId = $row->user_id;
                    $exists = DB::table('company_users')
                        ->where('company_id', $targetCompanyId)
                        ->where('user_id', $userId)
                        ->exists();

                    if ($exists) {
                        DB::table('company_users')
                            ->where('company_id', $company->id)
                            ->where('user_id', $userId)
                            ->delete();
                    } else {
                        DB::table('company_users')
                            ->where('company_id', $company->id)
                            ->where('user_id', $userId)
                            ->update(['company_id' => $targetCompanyId]);
                    }
                }

                $company->delete();
            }
        });

        $this->info("\n✅ Migration and cleanup completed!");
    }
}
