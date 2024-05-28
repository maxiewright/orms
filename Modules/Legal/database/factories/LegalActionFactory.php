<?php

namespace Modules\Legal\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LegalActionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Legal\Models\Litigation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

