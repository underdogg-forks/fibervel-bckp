<?php

namespace Modules\Crm\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Crm\Enums\ContactTypeEnum;
use Modules\Crm\Models\Contact;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'account_id'   => null,
            'company_id'   => null,
            'contact_type' => $this->faker->randomElement(ContactTypeEnum::cases()),
            'job_title'    => $this->faker->jobTitle,
            'first_name'   => $this->faker->firstName,
            'last_name'    => $this->faker->lastName(),
            'email'        => $this->faker->unique()->companyEmail,
            'phone'        => $this->faker->phoneNumber,
        ];
    }
}
