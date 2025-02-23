<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        //$corporations = Corporation::pluck('id')->toArray();

        Company::factory()
            ->count(5)
            ->create();
    }
}
