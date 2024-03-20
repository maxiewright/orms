<?php

namespace Modules\ServiceFund\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\ServiceFund\App\Models\Bank;
use Modules\ServiceFund\App\Models\BankBranch;

class BankBranchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = BankBranch::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'bank_id' => Bank::factory(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'address_line_1' => fake()->streetAddress(),
            'address_line_2' => null,
            'city_id' => app(config('servicefund.address.city'))::all()->random()->id,
        ];
    }
}
