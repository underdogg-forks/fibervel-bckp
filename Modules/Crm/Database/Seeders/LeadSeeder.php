<?php

namespace Modules\Crm\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Company;
use Modules\Crm\Models\Account;
use Modules\Crm\Models\Contact;
use Modules\Crm\Models\Lead;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        Company::all()->each(function ($company): void {
            Account::where('company_id', $company->id)->each(function ($account) use ($company): void {
                Lead::factory()
                    ->count(10)
                    ->create([
                        'company_id' => $company->id,
                        'account_id' => $account->id,
                        'contact_id' => Contact::where('company_id', $company->id)
                            ->inRandomOrder()
                            ->first()
                            ?->id,
                    ]);
            });
        });
    }
}
