<?php

namespace Database\Seeders;

use Database\Seeders\Interview\AttendeeRoleSeeder;
use Database\Seeders\Interview\InterviewReasonSeeder;
use Database\Seeders\Interview\InterviewStatusSeeder;
use Illuminate\Database\Seeder;

class InterviewSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AttendeeRoleSeeder::class,
            InterviewReasonSeeder::class,
            InterviewStatusSeeder::class,
        ]);
    }
}
