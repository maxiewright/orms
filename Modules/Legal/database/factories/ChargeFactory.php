<?php

namespace Modules\Legal\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Legal\Enums\Incident\OffenceType;
use Modules\Legal\Enums\JusticeInstitutionType;
use Modules\Legal\Models\Ancillary\Infraction\OffenceDivision;
use Modules\Legal\Models\Ancillary\JusticeInstitution;
use Modules\Legal\Models\Incident;

class ChargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Legal\Models\Charge::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {

        //        $offenceType = fake()->randomElement(OffenceType::cases());
        // TODO when more divisions and sections are added remove the summary offence types
        $offenceType = OffenceType::SummaryOffence;
        $offenceDivision = OffenceDivision::where('type', $offenceType)->first();
        $offenceSection = $offenceDivision->sections()->first();

        $policeRanks = ['PC', 'WPC', 'Cpl', 'Sgt', 'Inspt'];

        return [
            'offence_type' => $offenceType ?? 1,
            'offence_division_id' => $offenceDivision->id,
            'offence_section_id' => $offenceSection->id,
            'charged_at' => fake()->dateTimeBetween('-30 days', 'now'),
            'justice_institution_id' => JusticeInstitution::factory()->whereType(JusticeInstitutionType::PoliceStation),
            'charged_by' => fake()->randomElement($policeRanks).' '.fake()->firstName().' '.fake()->lastName(),
        ];

    }

    public function withIncident(Incident $incident): self
    {
        return $this->state(fn () => ['incident_id' => $incident->id]);
    }
}
