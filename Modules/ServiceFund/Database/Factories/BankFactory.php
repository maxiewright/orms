<?php

namespace Modules\ServiceFund\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\ServiceFund\App\Models\Bank;

class BankFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Bank::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'slug' => fake()->slug(),
        ];
    }
}
