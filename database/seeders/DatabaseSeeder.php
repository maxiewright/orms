<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use bfinlay\SpreadsheetSeeder\SpreadsheetSeeder;
use Database\Seeders\Interview\AttendeeRoleSeeder;
use Database\Seeders\Interview\InterviewReasonSeeder;
use Database\Seeders\Interview\InterviewStatusSeeder;
use Database\Seeders\Unit\BattalionSeeder;
use Database\Seeders\Unit\CompanySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            FormationSeeder::class,
            RankSeeder::class,
            GenderSeeder::class,
            EnlistmentTypeSeeder::class,
            SpreadsheetSeeder::class,
            AdminSeeder::class,
            OfficerAppraisalGradeSeeder::class,

            // Units
            BattalionSeeder::class,
            CompanySeeder::class,

            //Interview
            InterviewReasonSeeder::class,
            InterviewStatusSeeder::class,
            AttendeeRoleSeeder::class,

        ]);
    }
}
