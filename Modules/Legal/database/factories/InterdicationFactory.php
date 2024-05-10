<?php

namespace Modules\Legal\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InterdicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Legal\Models\Interdiction::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

