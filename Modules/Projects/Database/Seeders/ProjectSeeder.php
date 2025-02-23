<?php

namespace Modules\Projects\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\User;
use Modules\Projects\Enums\ProjectRoleEnum;
use Modules\Projects\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::all()->each(
            fn (Project $project) => $project->users()->attach(
                User::inRandomOrder()->limit(random_int(5, 10))->pluck('id')->toArray(),
                ['role' => ProjectRoleEnum::random()->value]
            )
        );
    }
}
