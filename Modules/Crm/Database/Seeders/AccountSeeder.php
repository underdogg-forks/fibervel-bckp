<?php

namespace Modules\Crm\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Company;
use Modules\Crm\Models\Contact;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        Account::factory()
            ->count(200)
            ->create(fn () => [
                'company_id' => Company::inRandomOrder()->value('id'),
            ]);
    }
}
