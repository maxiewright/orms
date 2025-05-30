<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class GovernmentOfficialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $governmentOfficialsSubjects = [
            //61.	Head of State/Ministries
            [
                'reference_number' => '6/1/1',
                'name' => 'His Excellency the President – Military Staff	',
                'index_sub_group_id' => 61,
            ],
            [
                'reference_number' => '6/1/2',
                'name' => 'Programme of Events of His Excellency',
                'index_sub_group_id' => 61,
            ],
            [
                'reference_number' => '6/1/3',
                'name' => 'Aid-de-Camp (ADC) to His Excellency',
                'index_sub_group_id' => 61,
            ],
            [
                'reference_number' => '6/1/4',
                'name' => 'The Honourable Prime Minister – Military Staff',
                'index_sub_group_id' => 61,
            ],
            [
                'reference_number' => '6/1/5',
                'name' => 'Ministers',
                'index_sub_group_id' => 61,
            ],

            //62. Ambassador High Commissions

            [
                'reference_number' => '6/2/1',
                'name' => 'Diplomats and Consular Corps',
                'index_sub_group_id' => 62,
            ],
            [
                'reference_number' => '6/2/2',
                'name' => 'Military Attaché - USA',
                'index_sub_group_id' => 62,
            ],
            [
                'reference_number' => '6/2/3',
                'name' => 'Military Attaché – United Kingdom',
                'index_sub_group_id' => 62,
            ],
            [
                'reference_number' => '6/2/4',
                'name' => 'Foreign Military Attaché/Postings',
                'index_sub_group_id' => 62,
            ],
            [
                'reference_number' => '6/2/5',
                'name' => 'Defence Attaché Venezuela',
                'index_sub_group_id' => 62,
            ],
        ];

        foreach ($governmentOfficialsSubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}
