<?php

namespace Modules\Crm\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Crm\Enums\LeadStatusEnum;
use Modules\Crm\Models\Account;
use Modules\Crm\Models\Contact;
use Modules\Crm\Models\Lead;

class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [
            'company_id'  => null,
            'account_id'  => Account::inRandomOrder()->first()->id,
            'contact_id'  => Contact::inRandomOrder()->first()->id,
            'lead_status' => $this->faker->randomElement(LeadStatusEnum::cases()),
            'company'     => $this->faker->company . ' Lead',
            'name'        => $this->faker->name . ' Lead',
            'email'       => $this->faker->unique()->safeEmail,
            'phone'       => $this->faker->phoneNumber,
        ];
    }
}
