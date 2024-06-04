<?php

namespace Modules\Legal\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Legal\Enums\LegalProfessionalType;
use Modules\Legal\Models\Ancillary\CourtAppearance\LegalProfessional;

class LegalProfessionalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = LegalProfessional::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(LegalProfessionalType::cases()),
            'name' => fake()->name(),
            'email' => fake()->unique()->email(),
            'phone' => fake()->unique()->phoneNumber(),
        ];
    }

    public function whereType(LegalProfessionalType $type): self
    {
        return $this->state(fn () => [
            'type' => $type,
        ]);
    }
}
