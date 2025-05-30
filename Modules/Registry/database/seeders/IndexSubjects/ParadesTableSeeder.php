<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ParadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $paradesSubjects = [
            //91. Internal
            [
                'reference_number' => '9/1/1',
                'name' => 'Commander in Chief of the Armed Forces / Invitation to Parade',
                'index_sub_group_id' => 91,
            ],
            [
                'reference_number' => '9/1/2',
                'name' => 'Chief of Defence Staff Parade',
                'index_sub_group_id' => 91,
            ],
            [
                'reference_number' => '9/1/3',
                'name' => 'TTR Anniversary Parade',
                'index_sub_group_id' => 91,
            ],
            [
                'reference_number' => '9/1/4',
                'name' => 'TTCG Anniversary Parade / TTAG Anniversary Parade',
                'index_sub_group_id' => 91,
            ],
            [
                'reference_number' => '9/1/5',
                'name' => 'Recruit Passing Out Parade',
                'index_sub_group_id' => 91,
            ],
            [
                'reference_number' => '9/1/6',
                'name' => 'Church Parade',
                'index_sub_group_id' => 91,
            ],
            [
                'reference_number' => '9/1/7',
                'name' => 'Divisions',
                'index_sub_group_id' => 91,
            ],
            [
                'reference_number' => '9/1/8',
                'name' => 'Officer Cadet Commissioning Parade',
                'index_sub_group_id' => 91,
            ],
            [
                'reference_number' => '9/1/9',
                'name' => 'Annual Regiment Drill Competition',
                'index_sub_group_id' => 91,
            ],
            [
                'reference_number' => '9/1/10',
                'name' => 'Hand Over of the Command of TTDF',
                'index_sub_group_id' => 91,
            ],
            [
                'reference_number' => '9/1/11',
                'name' => 'Regiment Scale ‘A’ Parade',
                'index_sub_group_id' => 91,
            ],
            [
                'reference_number' => '9/1/12',
                'name' => 'Military Tattoo',
                'index_sub_group_id' => 91,
            ],
            [
                'reference_number' => '9/1/13',
                'name' => 'Commissioning Ceremonies / Education Officer’s Parade (EO)',
                'index_sub_group_id' => 91,
            ],

            //92. National Ceremonial

            [
                'reference_number' => '9/2/1',
                'name' => 'Independence Parade / Parade Procedures',
                'index_sub_group_id' => 92,
            ],
            [
                'reference_number' => '9/2/2',
                'name' => 'Opening Law Courts',
                'index_sub_group_id' => 92,
            ],
            [
                'reference_number' => '9/2/3',
                'name' => 'Remembrance Day',
                'index_sub_group_id' => 92,
            ],
            [
                'reference_number' => '9/2/4',
                'name' => 'Opening Of Parliament',
                'index_sub_group_id' => 92,
            ],
            [
                'reference_number' => '9/2/5',
                'name' => 'Re-Consecration of Colours',
                'index_sub_group_id' => 92,
            ],
            [
                'reference_number' => '9/2/6',
                'name' => 'Republic Day Celebrations',
                'index_sub_group_id' => 92,
            ],
            [
                'reference_number' => '9/2/7',
                'name' => 'Guard of Honour / City Day Parade / Borough Day',
                'index_sub_group_id' => 92,
            ],
        ];

        foreach ($paradesSubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}
