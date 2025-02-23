<?php

namespace Modules\Projects\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Modules\Projects\Models\Project;
use Modules\Projects\Models\Task;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::pluck('id')->toArray();

        Task::factory()
            ->count(1000)
            ->create(fn () => [
                'project_id' => $projects[Arr::random($projects)],
            ]);
    }
}
