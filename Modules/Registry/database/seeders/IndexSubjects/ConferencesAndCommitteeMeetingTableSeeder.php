<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ConferencesAndCommitteeMeetingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $conferencesAndCommitteeMeetingSubjects = [
            //41.	Foreign
            [
                'reference_number' => '4/1',
                'name' => 'Caribbean Development and Co-operation',
                'index_sub_group_id' => 41,
            ],
            [
                'reference_number' => '4/1/1',
                'name' => 'Committee Meetings',
                'index_sub_group_id' => 41,
            ],
            [
                'reference_number' => '4/1/2',
                'name' => 'American Armies Conference',
                'index_sub_group_id' => 41,
            ],
            [
                'reference_number' => '4/1/3',
                'name' => 'United Nations Conference',
                'index_sub_group_id' => 41,
            ],
            [
                'reference_number' => '4/1/4',
                'name' => 'Heads of Caricom Government Conference/Wives of Heads of State and Government of America/Organisation of American States',
                'index_sub_group_id' => 41,
            ],
            [
                'reference_number' => '4/1/5',
                'name' => 'Military Conferences/Seminars',
                'index_sub_group_id' => 41,
            ],
            [
                'reference_number' => '4/1/6',
                'name' => 'Caribbean Drug Conference (PMO)',
                'index_sub_group_id' => 41,
            ],
            [
                'reference_number' => '4/1/7',
                'name' => 'CG Commanders Conference',
                'index_sub_group_id' => 41,
            ],
            [
                'reference_number' => '4/1/8',
                'name' => '(CICAD) Inter-American Drug Abuse Control Commission',
                'index_sub_group_id' => 41,
            ],
            [
                'reference_number' => '4/1/9',
                'name' => '(1st Annual) Caribbean Nations Maritime Law Conference',
                'index_sub_group_id' => 41,
            ],

            //42.   Local

            [
                'reference_number' => '4/2/1',
                'name' => 'Chief of Defence Staff Conference',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/2',
                'name' => 'Unit CO’s Conference – TTR',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/23',
                'name' => 'Unit CO’s Conference – CG',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/4',
                'name' => 'Strategic Planning Conference',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/5',
                'name' => 'Welfare Committee Meetings – Defence Force',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/6',
                'name' => 'Piarco and Crown Point Airports Conference',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/7',
                'name' => 'Seminars / Conferences in the Public Service/Law of Armed Conflict (Local)',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/8',
                'name' => 'Defence Council Meetings',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/9',
                'name' => 'DFHQ Officers Meetings / Defence Force Officer Meeting',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/10',
                'name' => 'Minister of National Security / TTDF / Protective Services / Head of Division',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/11',
                'name' => 'Minutes / Meeting Civil Organisation',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/12',
                'name' => 'Anniversary Celebrations Committee Meetings',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/13',
                'name' => 'Meeting of Tenders Committee within MNS – Special Tenders',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/14',
                'name' => 'Steering Committee Civilian Conservation Corps',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/15',
                'name' => 'Review 1990 Coup Attempt',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/16',
                'name' => 'Air Advisory Board',
                'index_sub_group_id' => 42,
            ],
            [
                'reference_number' => '4/2/17',
                'name' => 'NCC Security Committee',
                'index_sub_group_id' => 42,
            ],
        ];

        foreach ($conferencesAndCommitteeMeetingSubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}
