<?php

namespace Modules\Crm\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Modules\Crm\Enums\AccountTypeEnum;
use Modules\Crm\Models\Account;
use Modules\Crm\Models\Contact;
use Modules\Projects\Models\Project;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition(): array
    {
        return [
            'company_id'   => null,
            'account_type' => $this->faker->randomElement(AccountTypeEnum::cases()),
            'name'         => $this->faker->company . ' Account',
            'website'      => $this->faker->url,
            'phone'        => $this->faker->phoneNumber,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Model $model): void {
            /** @var Account $account */
            $account = $model;

            Contact::factory()->count(10)->create([
                'account_id' => $account->id,
                'company_id' => $account->company_id,
            ]);

            Project::factory()->count(5)->create([
                'account_id' => $account->id,
                'company_id' => $account->company_id,
            ]);

            /*Lead::factory()->count(1)->create([
                'account_id' => $account->id,
                'company_id' => $account->company_id,
                'contact_id' => Contact::inRandomOrder()->first()->id,
            ]);*/
        });
    }
}
