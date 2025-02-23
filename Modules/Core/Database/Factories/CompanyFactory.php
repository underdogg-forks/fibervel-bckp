<?php

namespace Modules\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Core\Models\Company;
use Modules\Crm\Models\Account;
use Modules\Crm\Models\Contact;
use Modules\Crm\Models\Lead;
use Modules\Projects\Models\Project;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        $companyName = $this->faker->company;

        return [
            'name'    => $companyName,
            'slug'    => Str::slug($companyName),
            'website' => $this->faker->url,
            'phone'   => $this->faker->phoneNumber,
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Model $model): void {
            /** @var Company $company */
            $company = $model;
            //User::factory()->count(5)->create(['company_id' => $company->id]);
            Account::factory()->count(3)->create(['company_id' => $company->id]);
            Contact::factory()->count(5)->create(['company_id' => $company->id]);
            Project::factory()->count(2)->create(['company_id' => $company->id]);
            Lead::factory()->count(3)->create(['company_id' => $company->id]);
        });
    }
}
