<?php

namespace Modules\Projects\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Modules\Projects\Enums\ProjectStatusEnum;
use Modules\Projects\Models\Project;
use Modules\Projects\Models\Task;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'company_id'    => null,
            'account_id'    => null,
            'project_stage' => $this->faker->randomElement(ProjectStatusEnum::cases()),
            'name'          => $this->faker->realText(15) . ' Project',
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Model $model): void {
            /** @var Project $project */
            $project = $model;
            Task::factory()->count(5)->create([
                'project_id' => $project->id,
            ]);
        });
    }
}
