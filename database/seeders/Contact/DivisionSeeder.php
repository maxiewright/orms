<?php

namespace Database\Seeders\Contact;

use App\Models\Metadata\Contact\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    public function run()
    {
        $divisions = [
            [
                'division_type_id' => 1,
                'name' => 'Couva/Tabaquite/Talparo',
                'slug' => 'CTT',
            ],
            [
                'division_type_id' => 1,
                'name' => 'Diego Martin',
                'slug' => 'DMN',
            ],
            [
                'division_type_id' => 1,
                'name' => 'Mayaro/Rio Claro',
                'slug' => 'MRC',
            ],
            [
                'division_type_id' => 1,
                'name' => 'Penal/Debe',
                'slug' => 'PED',
            ],
            [
                'division_type_id' => 1,
                'name' => 'Princes Town',
                'slug' => 'PRT',
            ],
            [
                'division_type_id' => 1,
                'name' => 'Sangre Grande',
                'slug' => 'SGE',
            ],
            [
                'division_type_id' => 1,
                'name' => 'San Juan/Laventille',
                'slug' => 'SJL',
            ],
            [
                'division_type_id' => 1,
                'name' => 'Siparia',
                'slug' => 'SIP',
            ],
            [
                'division_type_id' => 1,
                'name' => 'Tunapuna/Piarco',
                'slug' => 'TUP',
            ],
            [
                'division_type_id' => 2,
                'name' => 'Arima',
                'slug' => 'ARI',
            ],
            [
                'division_type_id' => 2,
                'name' => 'Chaguanas',
                'slug' => 'CHA',
            ],
            [
                'division_type_id' => 2,
                'name' => 'Point Fortin',
                'slug' => 'PTF',
            ],
            [
                'division_type_id' => 3,
                'name' => 'Post Of Spain',
                'slug' => 'POS',
            ],
            [
                'division_type_id' => 3,
                'name' => 'San Fernando',
                'slug' => 'SFO',
            ],
            [
                'division_type_id' => 4,
                'name' => 'Tobago',
                'slug' => 'TOB',
            ],
        ];

        foreach ($divisions as $division) {
            Division::query()->create([
                'division_type_id' => $division['division_type_id'],
                'name' => $division['name'],
                'slug' => $division['slug'],
            ]);
        }
    }
}
