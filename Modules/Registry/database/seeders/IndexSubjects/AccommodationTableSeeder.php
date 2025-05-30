<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Registry\Models\RegistryIndex\IndexSubject;

class AccommodationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $accommodationSubjects = [
            //11.	Camps
            [
                'reference_number' => '1/1/1',
                'name' => 'Teteron Barracks',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/2',
                'name' => 'Camp Ogden',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/3',
                'name' => 'Closed Camps (Union Hall, Siparia, Centeno, Point Lisas)',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/4',
                'name' => 'Crows Nest - RHQ',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/5',
                'name' => 'Camp Galeota',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/6',
                'name' => 'Tobago Camp',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/7',
                'name' => 'Wallerfield / Camp Cumuto',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/8',
                'name' => 'Mausica',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/9',
                'name' => 'La Romaine',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/10',
                'name' => 'Relocation of Camp Signal Hill / Hope Estate in Tobago',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/11',
                'name' => 'Point a Pierre (Proposed Camp)',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/12',
                'name' => 'Staubles Bay',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/13',
                'name' => 'Air Guard - Piarco',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/14',
                'name' => 'DFHQ / CDA ? Chaguaramas Area',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/15',
                'name' => 'Harts Cut(TTCG)',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/16',
                'name' => 'Heliport / National Helicopter Services Limited',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/17',
                'name' => 'Development of CG Base/ Morne St Catherine / Pt Lisas',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/18',
                'name' => 'Volunteer Defence Force - South',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/19',
                'name' => 'Air Strip - Point Fortin',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/20',
                'name' => 'Camp Mucurapo',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/21',
                'name' => 'Camp Signal hill',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/22',
                'name' => 'Cedros Security Complex',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/23',
                'name' => 'Proposed TTCG Base - San Fernando',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/24',
                'name' => 'Camp Omega',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/25',
                'name' => 'Proposed Military Base in South / Location RHQ',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/26',
                'name' => 'Proposed Military Base in Couva',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/27',
                'name' => 'Joint Operations Command Centre',
                'index_sub_group_id' => 11,
            ],
            [
                'reference_number' => '1/1/28',
                'name' => 'President / Prime Minister (Guard Quarters)',
                'index_sub_group_id' => 11,
            ],

            //12.   Housing

            [
                'reference_number' => '1/2/1',
                'name' => 'Government Quarters(Grandwood, Diamond Vale, Macqueripe, Petit Valley, Flag Staff)',
                'index_sub_group_id' => 12,
            ],
            [
                'reference_number' => '1/2/2',
                'name' => 'Private Hiring',
                'index_sub_group_id' => 12,
            ],
            [
                'reference_number' => '1/2/3',
                'name' => 'Reserved',
                'index_sub_group_id' => 12,
            ],
            [
                'reference_number' => '1/2/4',
                'name' => 'National Housing ',
                'index_sub_group_id' => 12,
            ],
            [
                'reference_number' => '1/2/5',
                'name' => 'Assistance to purchase Land and House',
                'index_sub_group_id' => 12,
            ],
            [
                'reference_number' => '1/2/6',
                'name' => 'Casualty Report',
                'index_sub_group_id' => 12,
            ],
            [
                'reference_number' => '1/2/7',
                'name' => 'Illegal Operation of Defence Force Quarters',
                'index_sub_group_id' => 12,
            ],
            [
                'reference_number' => '1/2/8',
                'name' => 'Officers Rest House / Bachelor Quarters (BOQ)',
                'index_sub_group_id' => 12,
            ],
            [
                'reference_number' => '1/2/9',
                'name' => 'Defence Force Housing Scheme',
                'index_sub_group_id' => 12,
            ],
        ];

        foreach ($accommodationSubjects as $accommodationSubject) {
            IndexSubject::create($accommodationSubject);
        }
    }
}
