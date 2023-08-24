<?php

namespace Database\Seeders\BasicInformationSeeder;

use Illuminate\Database\Seeder;

class BasicInformationSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            EthnicitySeeder::class,
            MaritalStatusSeeder::class,
            RelationshipSeeder::class,
            ReligionSeeder::class,
        ]);

    }
}
