<?php

namespace Database\Seeders\BasicInformationSeeder;

use App\Models\Metadata\PersonalInformation\MaritalStatus;
use Illuminate\Database\Seeder;

class MaritalStatusSeeder extends Seeder
{
    public function run()
    {
        $maritalStatuses = [
            'Single',
            'Married',
            'Divorced',
            'Widowed',
            'Common-law',
        ];

        foreach ($maritalStatuses as $status) {
            MaritalStatus::query()->create([
                'name' => $status,
            ]);
        }
    }
}
