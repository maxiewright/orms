<?php

namespace Modules\Registry\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Registry\Database\Seeders\IndexSubjects\AccommodationTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\AdministrationTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\BoardsTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\ConferencesAndCommitteeMeetingTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\EstablishmentTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\FinancialAndAccountingMattersTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\FuneralsAndWarGravesTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\GovernmentOfficialsTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\MentalAndDentalTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\OperationsTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\ParadesTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\PersonnelTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\SecurityTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\SportsTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\TrainingTableSeeder;
use Modules\Registry\Database\Seeders\IndexSubjects\VolunteerTableSeeder;

class IndexSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            AccommodationTableSeeder::class,
            AdministrationTableSeeder::class,
            BoardsTableSeeder::class,
            ConferencesAndCommitteeMeetingTableSeeder::class,
            EstablishmentTableSeeder::class,
            FinancialAndAccountingMattersTableSeeder::class,
            FuneralsAndWarGravesTableSeeder::class,
            GovernmentOfficialsTableSeeder::class,
            MentalAndDentalTableSeeder::class,
            OperationsTableSeeder::class,
            ParadesTableSeeder::class,
            PersonnelTableSeeder::class,
            SecurityTableSeeder::class,
            SportsTableSeeder::class,
            TrainingTableSeeder::class,
            VolunteerTableSeeder::class,
        ]);
    }
}
