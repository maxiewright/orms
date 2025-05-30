<?php

namespace Modules\Registry\Database\Seeders;

use Illuminate\Database\Seeder;

class RegistryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            IndexGroupSeeder::class,
            IndexSubGroupSeeder::class,
            IndexSubjectSeeder::class,
        ]);
    }
}
