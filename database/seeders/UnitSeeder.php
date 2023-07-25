<?php

namespace Database\Seeders;

use Database\Seeders\Unit\BattalionSeeder;
use Database\Seeders\Unit\CompanySeeder;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            BattalionSeeder::class,
            CompanySeeder::class,
        ]);
    }
}
