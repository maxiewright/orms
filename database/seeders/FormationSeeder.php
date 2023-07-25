<?php

namespace Database\Seeders;

use App\Models\Unit\Formation;
use Illuminate\Database\Seeder;

class FormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formations = [
            [
                'name' => 'Trinidad and Tobago Regiment',
                'short_name' => 'Regiment',
                'abbreviation' => 'TTR',
            ],
            [
                'name' => 'Trinidad and Tobago Coast Guard',
                'short_name' => 'Coast Guard',
                'abbreviation' => 'TTCG',
            ],
            [
                'name' => 'Trinidad and Tobago Air Guard',
                'short_name' => 'Air Guard',
                'abbreviation' => 'TTAG',
            ],
        ];

        foreach ($formations as $formation) {
            Formation::query()->create([
                'name' => $formation['name'],
                'short_name' => $formation['short_name'],
                'abbreviation' => $formation['abbreviation'],
            ]);
        }

    }
}
