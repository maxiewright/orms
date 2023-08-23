<?php

namespace Database\Seeders\BasicInformationSeeder;

use App\Models\Metadata\PersonalInformation\NextOfKinRelationship;
use Illuminate\Database\Seeder;

class NextOfKinRelationshipSeeder extends Seeder
{
    public function run()
    {
        $relationships = [
            'Son',
            'Daughter',
            'Spouse',
            'Nephew',
            'Niece',
            'Friend',
        ];

        foreach ($relationships as $relationship) {
            NextOfKinRelationship::query()->create([
                'name' => $relationship,
            ]);
        }
    }
}
