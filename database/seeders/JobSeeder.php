<?php

namespace Database\Seeders;

use Database\Seeders\Jobs\AdminAndPersonnelJobSeeder;
use Database\Seeders\Jobs\AdvisoryJobSeeder;
use Database\Seeders\Jobs\CommandJobSeeder;
use Database\Seeders\Jobs\EngineerJobSeeder;
use Database\Seeders\Jobs\ICTJobSeeder;
use Database\Seeders\Jobs\InfantryJobSeeder;
use Database\Seeders\Jobs\IntelligenceJobSeeder;
use Database\Seeders\Jobs\LogsAndFinanceJobSeeder;
use Database\Seeders\Jobs\MaintenanceJobSeeder;
use Database\Seeders\Jobs\MedicalJobSeeder;
use Database\Seeders\Jobs\MessingJobSeeder;
use Database\Seeders\Jobs\OpsAndTrgJobSeeder;
use Database\Seeders\Jobs\PRJobSeeder;
use Database\Seeders\Jobs\QuartermasterJobSeeder;
use Database\Seeders\Jobs\SpecialForcesJobSeeder;
use Database\Seeders\Jobs\SupplyServicesJobSeeder;
use Database\Seeders\Jobs\SupportWeaponsJobSeeder;
use Database\Seeders\Jobs\TransportJobSeeder;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminAndPersonnelJobSeeder::class,
            AdvisoryJobSeeder::class,
            CommandJobSeeder::class,
            EngineerJobSeeder::class,
            ICTJobSeeder::class,
            InfantryJobSeeder::class,
            IntelligenceJobSeeder::class,
            LogsAndFinanceJobSeeder::class,
            MaintenanceJobSeeder::class,
            MedicalJobSeeder::class,
            MessingJobSeeder::class,
            OpsAndTrgJobSeeder::class,
            PRJobSeeder::class,
            QuartermasterJobSeeder::class,
            SpecialForcesJobSeeder::class,
            SupplyServicesJobSeeder::class,
            SupportWeaponsJobSeeder::class,
            TransportJobSeeder::class,
        ]);
    }
}
