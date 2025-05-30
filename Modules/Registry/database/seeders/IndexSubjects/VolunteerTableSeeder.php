<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class VolunteerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $volunteerDefenceForceSubjects = [
            //151. TTR
            [
                'reference_number' => '15/1/1',
                'name' => 'Matters Affecting VDF',
                'index_sub_group_id' => 151,
            ],
            [
                'reference_number' => '15/1/2',
                'name' => 'Permanent Staff Volunteers (Contracted)',
                'index_sub_group_id' => 151,
            ],
            [
                'reference_number' => '15/1/3',
                'name' => 'VDF – Regulations',
                'index_sub_group_id' => 151,
            ],
            [
                'reference_number' => '15/1/4',
                'name' => 'VDF Officers on Contract',
                'index_sub_group_id' => 151,
            ],
            [
                'reference_number' => '15/1/5',
                'name' => 'VDF Training Programme',
                'index_sub_group_id' => 151,
            ],
            [
                'reference_number' => '15/1/6',
                'name' => 'Recruitment VDF (TTR)',
                'index_sub_group_id' => 151,
            ],
            [
                'reference_number' => '15/1/7',
                'name' => 'Discharges VDF (TTR)',
                'index_sub_group_id' => 151,
            ],
            [
                'reference_number' => '15/1/8',
                'name' => 'Parades',
                'index_sub_group_id' => 151,
            ],
            [
                'reference_number' => '15/1/9',
                'name' => 'Promotion – Other Ranks',
                'index_sub_group_id' => 151,
            ],
            [
                'reference_number' => '15/1/10',
                'name' => 'Promotion – Officers',
                'index_sub_group_id' => 151,
            ],
            [
                'reference_number' => '15/1/11',
                'name' => 'Children Christmas Party / Carnival Dance / Family Day / Welfare Activities',
                'index_sub_group_id' => 151,
            ],

            //152. TTCG

            [
                'reference_number' => '15/2/1',
                'name' => 'Formation of VDF – CG/Recruitment',
                'index_sub_group_id' => 152,
            ],
            [
                'reference_number' => '15/2/2',
                'name' => 'Coast Guard Auxiliary',
                'index_sub_group_id' => 152,
            ],

        ];
        foreach ($volunteerDefenceForceSubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}
