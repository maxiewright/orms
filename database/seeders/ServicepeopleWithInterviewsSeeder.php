<?php

namespace Database\Seeders;

use App\Enums\Interview\InterviewStatusEnum as Status;
use App\Models\Interview;
use App\Models\Serviceperson;
use Illuminate\Database\Seeder;

class ServicepeopleWithInterviewsSeeder extends Seeder
{
    public function run(): void
    {
        Serviceperson::factory(50)
            ->has(Interview::factory()->whereStatus(Status::PENDING))
            ->enlisted()
            ->create();

        Serviceperson::factory(15)
            ->hasInterviews(2)
            ->officer()
            ->create();
    }
}
