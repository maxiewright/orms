<?php

namespace Modules\Legal\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourtAttendenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Legal\Models\CourtAttendence::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

