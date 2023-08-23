<?php

namespace Database\Seeders\BasicInformationSeeder;

use App\Models\Metadata\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    public function run()
    {
        $genders = [
            'male',
            'female',
        ];

        foreach ($genders as $gender) {
            Gender::create([
                'name' => $gender,
            ]);
        }
    }
}
