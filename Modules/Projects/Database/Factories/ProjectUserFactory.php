<?php

namespace Modules\Projects\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Core\Models\User;
use Modules\Projects\Models\Project;
use Modules\Projects\Models\ProjectUser;

class ProjectUserFactory extends Factory
{
    protected $model = ProjectUser::class;

    public function definition(): array
    {
        return [
            'project_id' => Project::inRandomOrder()->first()->id,
            'user_id'    => User::inRandomOrder()->first()->id,
        ];
    }
}
