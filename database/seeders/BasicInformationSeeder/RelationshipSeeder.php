<?php

namespace Database\Seeders\BasicInformationSeeder;

use App\Models\Metadata\PersonalInformation\Relationship;
use Illuminate\Database\Seeder;

class RelationshipSeeder extends Seeder
{
    public function run(): void
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
            Relationship::query()->create([
                'name' => $relationship,
            ]);
        }
    }
}
