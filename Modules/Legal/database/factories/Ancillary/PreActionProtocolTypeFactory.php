<?php

namespace Modules\Legal\Database\Factories\Ancillary;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Legal\Models\Ancillary\Litigation\PreActionProtocolType;

class PreActionProtocolTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = PreActionProtocolType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'description' => fake()->paragraph(),
        ];
    }
}

