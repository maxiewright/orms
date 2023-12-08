<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use bfinlay\SpreadsheetSeeder\SpreadsheetSeeder;
use Database\Seeders\BasicInformationSeeder\GenderSeeder;
use Database\Seeders\Interview\AttendeeRoleSeeder;
use Database\Seeders\Interview\InterviewReasonSeeder;
use Database\Seeders\Interview\InterviewStatusSeeder;
use Database\Seeders\ServiceData\EnlistmentTypeSeeder;
use Database\Seeders\ServiceData\RankSeeder;
use Database\Seeders\Unit\BattalionSeeder;
use Database\Seeders\Unit\CompanySeeder;
use Database\Seeders\Unit\FormationSeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    protected array $toTruncate = [
        'officer_appraisal_grades',
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Model::unguard();

        Schema::disableForeignKeyConstraints();

        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        Schema::enableForeignKeyConstraints();

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

            //Employment
            ReleaseServicepersonEmploymentStatusSeeder::class,
        ]);
    }
}
