<?php

namespace Modules\ServiceFund\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Bank;
use Modules\ServiceFund\Enums\AccountTypeEnum;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {

        return [
            'company_id' => app(config('servicefund.company.model'))::all()->random()->id,
            'type' => fake()->randomElement(AccountTypeEnum::cases()),
            'name' => fake()->userName(),
            'number' => fake()->randomNumber(6),
            'bank_id' => Bank::factory(),
            'opening_balance' => fake()->randomNumber(5),
            'active_at' => now(),
        ];
    }
}
