<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class TrainingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $trainingSubjects = [
            //121. Foreign Training Programmes / Estimates
            [
                'reference_number' => '12/1',
                'name' => 'Training Estimates Programme',
                'index_sub_group_id' => 121,
            ],
            [
                'reference_number' => '12/1/1',
                'name' => 'Training UK and European Countries',
                'index_sub_group_id' => 121,
            ],
            [
                'reference_number' => '12/1/2',
                'name' => 'United States of America',
                'index_sub_group_id' => 121,
            ],
            [
                'reference_number' => '12/1/3',
                'name' => 'Canada',
                'index_sub_group_id' => 121,
            ],
            [
                'reference_number' => '12/1/4',
                'name' => 'South American Countries',
                'index_sub_group_id' => 121,
            ],
            [
                'reference_number' => '12/1/5',
                'name' => 'Caribbean Countries',
                'index_sub_group_id' => 121,
            ],
            [
                'reference_number' => '12/1/6',
                'name' => 'Course Reports – Officers',
                'index_sub_group_id' => 121,
            ],
            [
                'reference_number' => '12/1/7',
                'name' => 'Course Reports – Other Ranks/Ratings',
                'index_sub_group_id' => 121,
            ],
            [
                'reference_number' => '12/1/8',
                'name' => 'Movement Instructions',
                'index_sub_group_id' => 121,
            ],
            [
                'reference_number' => '12/1/9',
                'name' => 'Small Units Exchange Canada / Exchange of Troops',
                'index_sub_group_id' => 121,
            ],
            [
                'reference_number' => '12/1/10',
                'name' => 'Scholarship',
                'index_sub_group_id' => 121,
            ],

            //122. Local

            [
                'reference_number' => '12/2/1',
                'name' => 'Resettlement Training',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/2',
                'name' => 'In-service Training',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/3',
                'name' => 'Physical Training Instructors Course',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/4',
                'name' => 'Central Training Unit Course (CTU/O & M)	',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/5',
                'name' => 'Joint Services Staff College Course',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/6',
                'name' => 'Cadre / Infantry Training / Fitness Trg / WO Course',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/7',
                'name' => 'Clerks Course / Signals',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/8',
                'name' => 'Training Policy',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/9',
                'name' => 'Scholarships',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/10',
                'name' => 'Assistance to Units with Training',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/11',
                'name' => 'Recruitment Training',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/12',
                'name' => 'Assistance to Gov’t Department / Schools with Training/YTEPP',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/13',
                'name' => 'Officer Cadet Training',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/14',
                'name' => 'Computer Training',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/15',
                'name' => 'AirWing Pilot',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/16',
                'name' => 'Small Arms Course',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/17',
                'name' => 'Assistance / Training by Foreign Personnel / Assistance / Training by Local Personnel',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/18',
                'name' => 'Training / Seminars / Workshops',
                'index_sub_group_id' => 122,
            ],
            [
                'reference_number' => '12/2/19',
                'name' => 'National Training Agency (NTA)',
                'index_sub_group_id' => 122,
            ],
        ];
        foreach ($trainingSubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}
