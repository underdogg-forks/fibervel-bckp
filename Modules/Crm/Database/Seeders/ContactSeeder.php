<?php

namespace Modules\Crm\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Company;
use Modules\Crm\Models\Account;
use Modules\Crm\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Company::all()->each(function ($company): void {
            Account::where('company_id', $company->id)->each(function ($account) use ($company): void {
                Contact::factory()
                    ->count(15)
                    ->create([
                        'company_id' => $company->id,
                        'account_id' => $account->id,
                    ]);
            });
        });
    }
}
