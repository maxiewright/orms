<?php

namespace Modules\Legal\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LegalProfesionalTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Legal\Models\Ancillary\CourtAppearance\LegalProfessionalType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

