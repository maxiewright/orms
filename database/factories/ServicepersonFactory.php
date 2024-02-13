<?php

namespace Database\Factories;

use App\Actions\GetCompulsoryRetirementAgeAction;
use App\Enums\RankEnum;
use App\Enums\ServiceData\EnlistmentTypeEnum;
use App\Enums\ServiceData\FormationEnum;
use App\Models\Metadata\Contact\City;
use App\Models\Metadata\Gender;
use App\Models\Metadata\PersonalInformation\Ethnicity;
use App\Models\Metadata\PersonalInformation\MaritalStatus;
use App\Models\Metadata\PersonalInformation\Religion;
use App\Models\Metadata\ServiceData\EmploymentStatus;
use App\Models\Metadata\ServiceData\Job;
use App\Models\Unit\Battalion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

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

        $battalion = Battalion::all()->random();

        return [
            // Service Data
            'formation_id' => FormationEnum::Regiment,

            // Basic Information
            'image' => fake()->imageUrl(),
            'first_name' => fake()->firstName(),
            'middle_name' => null,
            'last_name' => fake()->lastName(),
            'other_names' => null,
            'gender_id' => Gender::all()->random()->id,
            'marital_status_id' => MaritalStatus::all()->random()->id,
            'religion_id' => Religion::all()->random()->id,
            'ethnicity_id' => Ethnicity::all()->random()->id,

            //Employment Information
            'employment_status_id' => EmploymentStatus::all()->random()->id,
            'battalion_id' => $battalion->id,
            'company_id' => $battalion->companies->random()->id,
            'job_id' => Job::all()->random()->id,

            // Contact
            'address_line_1' => fake()->streetAddress(),
            'address_line_2' => null,
            'city_id' => City::all()->random()->id,

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
            'number' => fake()->unique()->numberBetween(300, 700),
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
            'number' => fake()->unique()->numberBetween(9000, 14000),
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
}
