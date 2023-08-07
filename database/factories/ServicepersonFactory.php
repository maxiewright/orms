<?php

namespace Database\Factories;

use App\Actions\GetCompulsoryRetirementAgeAction;
use App\Enums\EnlistmentTypeEnum;
use App\Enums\RankEnum;
use App\Models\Metadata\Gender;
use App\Models\Unit\Formation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Serviceperson>
 */
class ServicepersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'formation_id' => Formation::all()->random()->id,
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'gender_id' => Gender::all()->random()->id,
        ];
    }

    public function officer(): Factory
    {
        $retirementAge = new GetCompulsoryRetirementAgeAction;
        $rank = fake()->numberBetween(RankEnum::O1->value, RankEnum::O5->value);
        $officerType = collect([
            EnlistmentTypeEnum::regularOfficer->value,
            EnlistmentTypeEnum::specialServiceOfficer->value,
        ]);
        $enlistmentDate = $this->getEnlistmentDate($rank);

        return $this->state(fn () => [
            'number' => fake()->unique()->numberBetween(300, 500),
            'rank_id' => $rank,
            'enlistment_date' => $enlistmentDate,
            'assumption_date' => fake()->dateTimeBetween(
                $enlistmentDate,
                Carbon::make($enlistmentDate)->addMonths(3)),
            'enlistment_type_id' => $officerType->random(),
            'date_of_birth' => fake()->dateTimeBetween(
                $retirementAge->getRetirementAge($rank), '-18 years'
            ),
        ]);
    }

    public function enlisted(): Factory
    {
        $retirementAge = new GetCompulsoryRetirementAgeAction;
        $rank = fake()->numberBetween(RankEnum::E1->value, RankEnum::E8->value);

        return $this->state(fn () => [
            'number' => fake()->unique()->numberBetween(10000, 14000),
            'rank_id' => $rank,
            'enlistment_date' => $this->getEnlistmentDate($rank),
            'enlistment_type_id' => EnlistmentTypeEnum::enlisted->value,
            'date_of_birth' => fake()->dateTimeBetween(
                $retirementAge->getRetirementAge($rank), '-18 years'
            ),
        ]);
    }

    public function getEnlistmentDate($rank): \DateTime
    {
        $retirementAge = new GetCompulsoryRetirementAgeAction;

        return fake()->dateTimeBetween($retirementAge->getRetirementAge($rank));
    }

    public function ma()
    {

    }
}
