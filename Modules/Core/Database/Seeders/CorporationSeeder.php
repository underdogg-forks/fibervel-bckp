<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Corporation;

class CorporationSeeder extends Seeder
{
    public function run(): void
    {
        Corporation::factory()->count(2)->create();
    }
}
