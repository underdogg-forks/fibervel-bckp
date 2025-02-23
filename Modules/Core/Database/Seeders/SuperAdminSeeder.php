<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Core\Models\Role;
use Modules\Core\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name'     => 'super-admin',
                'password' => Hash::make('password'),
            ]
        );

        $role = Role::where('name', 'super-admin')->first();

        if ($role) {
            $superAdmin->assignRole($role);
        }

        $this->command->info('Super Admin seeded successfully!');
    }
}
