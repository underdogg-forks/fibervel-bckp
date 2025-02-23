<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Projects\Database\Seeders\TaskSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Seeding data...');

        $seeders = [
            //CorporationSeeder::class,
            //CompanySeeder::class,
            //RoleSeeder::class,
            //UserSeeder::class,
            //SuperAdminSeeder::class,
            //AccountSeeder::class,
            //ContactSeeder::class,
            //ProjectSeeder::class,
            //LeadSeeder::class,
            TaskSeeder::class,
        ];

        $bar = $this->command->getOutput()->createProgressBar(count($seeders));

        $bar->start();

        foreach ($seeders as $seeder) {
            $this->call($seeder);
            $bar->advance();
        }

        $bar->finish();

        $this->command->info("\nSeeding completed!");
    }
}
