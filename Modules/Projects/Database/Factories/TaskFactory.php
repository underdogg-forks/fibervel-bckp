<?php

namespace Modules\Projects\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Projects\Enums\TaskStatusEnum;
use Modules\Projects\Models\Project;
use Modules\Projects\Models\Task;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'project_id'  => Project::inRandomOrder()->first()->id,
            'status'      => $this->faker->randomElement(TaskStatusEnum::cases()), // Using Enum
            'subject'     => $this->faker->realText(10),
            'due_at'      => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'description' => null,
        ];
    }
}
