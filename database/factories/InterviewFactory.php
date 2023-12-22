<?php

namespace Database\Factories;

use App\Models\Interview;
use App\Models\Metadata\InterviewReason;
use App\Models\Metadata\InterviewStatus;
use App\Models\Serviceperson;
use App\Models\Unit\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterviewFactory extends Factory
{
    protected $model = Interview::class;

    public function definition()
    {
        $dateRequested = fake()->dateTimeBetween('-60 days', '-30 days');
        $dateSeen = fake()->dateTimeBetween($dateRequested);

        return [
            'company_id' => Company::all()->random()->id,
            'requested_by' => Serviceperson::factory()->officer(),
            'requested_at' => $dateRequested,
            'interview_status_id' => InterviewStatus::all()->random()->id,
            'interview_reason_id' => InterviewReason::all()->random()->id,
            'subject' => fake()->sentence(),
            'particulars' => fake()->paragraph(),
            'seen_at' => $dateSeen,
            'seen_by' => Serviceperson::factory()->officer(),
        ];
    }

    public function hasPreviousInterview(): InterviewFactory
    {
        return $this->state(fn() => [
           'parent_id' => Interview::factory(),
        ]);
    }
}
