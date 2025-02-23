<?php

namespace Modules\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Models\Company;
use Modules\Core\Models\Corporation;

class CorporationFactory extends Factory
{
    protected $model = Corporation::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Corporation',
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Model $model): void {
            /** @var Corporation $corporation */
            $corporation = $model;
            Company::factory()->count(3)->create(['corporation_id' => $corporation->id]);
        });
    }
}
