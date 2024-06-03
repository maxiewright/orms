<?php

namespace Modules\Legal\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Legal\Enums\JusticeInstitutionType;
use Modules\Legal\Models\Ancillary\JusticeInstitution;
use Modules\Legal\Models\Incident;

class IncarcerationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Legal\Models\Incarceration::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $incarcerationDate = fake()->dateTimeBetween('-60 days');
        $correctionalFacility = JusticeInstitution::factory()
            ->whereType(JusticeInstitutionType::CorrectionalFacility)
            ->create();

        return [
            'incident_id' => Incident::factory(),
            'incarcerated_at' => $incarcerationDate,
            'justice_institution_id' => $correctionalFacility,
            'released_at' => null,
            'particulars' => fake()->paragraph(),
        ];
    }

    public function released(): self
    {
        $incarcerationDated = fake()->dateTimeBetween('-120 days');

        return $this->state(fn () => [
            'incarcerated_at' => $incarcerationDated,
            'released_at' => fake()->dateTimeBetween($incarcerationDated),
        ]);
    }
}
