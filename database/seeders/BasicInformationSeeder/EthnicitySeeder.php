<?php

namespace Database\Seeders\BasicInformationSeeder;

use App\Models\Metadata\PersonalInformation\Ethnicity;
use Illuminate\Database\Seeder;

class EthnicitySeeder extends Seeder
{
    public function run(): void
    {
        $ethnicities = [
            'African-Trinbagonian',
            'Arab-Trinbagonian',
            'Chinese-Trinbagonian',
            'Cocoa Panyol',
            'Dougla',
            'European-Trinbagonian',
            'Indigenous',
            'Indo-Trinbagonian',
            'Mixed',
            'Mulatto-Creole',
        ];

        foreach ($ethnicities as $ethnicity) {
            Ethnicity::query()->create([
                'name' => $ethnicity,
            ]);
        }
    }
}
