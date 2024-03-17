<?php

namespace Modules\ServiceFund\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Bank;
use Modules\ServiceFund\Enums\AccountType;

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
        $name = fake()->userName();
        $minimumSignatories = fake()->numberBetween(1, 3);

        return [
            'company_id' => app(config('servicefund.company.model'))::all()->random()->id,
            'type' => fake()->randomElement(AccountType::cases()),
            'name' => $name,
            'slug' => Str::slug($name),
            'number' => fake()->randomNumber(6),
            'bank_id' => Bank::factory(),
            'opening_balance_in_cents' => fake()->numberBetween(10000, 500000),
            'minimum_signatories' => $minimumSignatories,
            'maximum_signatories' => fake()->numberBetween($minimumSignatories, 3),
            'active_at' => now(),
        ];
    }
}
