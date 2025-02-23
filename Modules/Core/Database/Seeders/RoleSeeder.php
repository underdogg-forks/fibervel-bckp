<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'super-admin',
            'admin',
            'company-admin',
            'manager',
            'project-manager',
            'staff',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        $this->command->info('Roles seeded successfully!');
    }
}
