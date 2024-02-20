<?php

namespace Modules\ServiceFund\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccountSignatoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\ServiceFund\App\Models\AccountSignatory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

