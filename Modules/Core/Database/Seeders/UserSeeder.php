<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Core\Models\Company;
use Modules\Core\Models\Role;
use Modules\Core\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = Role::where('name', '!=', 'super-admin')->pluck('name')->toArray();

        User::factory()->count(50)->create()->each(function (Model $model) use ($roles): void {
            /** @var User $user */
            $user = $model;

            $companyIds = Company::inRandomOrder()->take(random_int(1, 3))->pluck('id');
            $user->companies()->attach($companyIds);

            $randomRole = $roles[array_rand($roles)];
            $user->assignRole($randomRole);
        });
    }
}
