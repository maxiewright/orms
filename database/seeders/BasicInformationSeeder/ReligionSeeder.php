<?php

namespace Database\Seeders\BasicInformationSeeder;

use App\Models\Metadata\PersonalInformation\Religion;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    public function run(): void
    {
        $religions = [
            'Anglican',
            'Baha\'i',
            'Baptist',
            'Buddhism',
            'Hindu',
            'Jehovah\'s Witness',
            'Muslim',
            'Non-religious',
            'Other',
            'Pentecostal',
            'Presbyterian',
            'Roman Catholic',
            'Seventh-Day Adventist',
        ];

        foreach ($religions as $religion) {
            Religion::query()->create([
                'name' => $religion,
            ]);
        }
    }
}
