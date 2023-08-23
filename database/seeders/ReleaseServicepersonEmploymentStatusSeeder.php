<?php

namespace Database\Seeders;

use Database\Seeders\BasicInformationSeeder\BasicInformationSeeder;
use Database\Seeders\Contact\ContactSeeder;
use Database\Seeders\ServiceData\EmploymentStatusSeeder;
use Database\Seeders\Unit\DepartmentSeeder;
use Illuminate\Database\Seeder;

class ReleaseServicepersonEmploymentStatusSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ContactSeeder::class,
            BasicInformationSeeder::class,
            EmploymentStatusSeeder::class,
            DepartmentSeeder::class,
            JobCategorySeeder::class,
            JobSeeder::class,
        ]);

    }
}
