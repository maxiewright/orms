<?php

namespace Database\Seeders;

use App\Models\Metadata\EnlistmentType;
use Illuminate\Database\Seeder;

class EnlistmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $enlistmentTypes = [
            [
                'name' => 'Enlisted',
                'abbreviation' => 'E',
            ],
            [
                'name' => 'Regular Officer',
                'abbreviation' => 'O',
            ],
            [
                'name' => 'Special Service Officer',
                'abbreviation' => 'SSO',
            ],
        ];

        foreach ($enlistmentTypes as $enlistmentType) {
            EnlistmentType::query()->create([
                'name' => $enlistmentType['name'],
                'abbreviation' => $enlistmentType['abbreviation'],
            ]);
        }

    }
}
