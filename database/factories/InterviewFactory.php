<?php

namespace Database\Factories;

use App\Enums\Interview\InterviewStatusEnum as Status;
use App\Models\Interview;
use App\Models\Metadata\InterviewReason;
use App\Models\Serviceperson;
use App\Models\Unit\Company;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterviewFactory extends Factory
{
    protected $model = Interview::class;

    public function definition()
    {

        return [
            'company_id' => Company::all()->random()->id,
            'requested_by' => Serviceperson::officers()->get()->random()->number,
            'requested_at' => $this->dateRequested(),
            'interview_reason_id' => InterviewReason::all()->random()->id,
            'subject' => fake()->sentence(),
            'particulars' => fake()->paragraph(),
        ];
    }

    public function seen(): InterviewFactory
    {

        return $this->state(fn() => [
            'interview_status_id' => Status::SEEN,
            'seen_at' => fake()->dateTimeBetween($this->dateRequested()),
            'seen_by' => Serviceperson::officers()->get()->random()->number,
        ]);
    }

    public function pending(): InterviewFactory
    {
        return $this->state(fn() => [
            'interview_status_id' => Status::PENDING,
            $this->notSeen(),
        ]);
    }

    public function cancelled(): InterviewFactory
    {
        return $this->state(fn() => [
            'interview_status_id' => Status::CANCELED,
             $this->notSeen(),
        ]);
    }


    public function hasPreviousInterview(): InterviewFactory
    {
        return $this->state(fn() => [
            'parent_id' => Interview::factory(),
        ]);
    }

    private function dateRequested(): DateTime
    {
        return fake()->dateTimeBetween('-2 years', '-30 days');
    }

    private function notSeen(): array
    {
        return [
            'seen_at' => null,
            'seen_by' => null,
        ];
    }

}
