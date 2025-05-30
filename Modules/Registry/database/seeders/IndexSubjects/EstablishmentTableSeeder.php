<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class EstablishmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $establishmentSubjects = [
            //111. Recruitment
            [
                'reference_number' => '11/1/1',
                'name' => 'Establishment – TTDF / Recruitment Officers',
                'index_sub_group_id' => 111,
            ],
            [
                'reference_number' => '11/1/2',
                'name' => 'Parade / Complement State / Establishment Proposal/Mr Bender',
                'index_sub_group_id' => 111,
            ],
            [
                'reference_number' => '11/1/3',
                'name' => 'Recruitment – TTDF (Other Ranks) / Application for Enlistment – Other Ranks',
                'index_sub_group_id' => 111,
            ],
            [
                'reference_number' => '11/1/4',
                'name' => 'Re-Enlistment',
                'index_sub_group_id' => 111,
            ],
            [
                'reference_number' => '11/1/5',
                'name' => 'Re-Engagement',
                'index_sub_group_id' => 111,
            ],
            [
                'reference_number' => '11/1/6',
                'name' => 'Officers on Contract',
                'index_sub_group_id' => 111,
            ],

            //112. Discharge / Retirement / Resignation

            [
                'reference_number' => '11/2/1',
                'name' => 'Retirement Officers',
                'index_sub_group_id' => 112,
            ],
            [
                'reference_number' => '11/2/2',
                'name' => 'Resignation Officers',
                'index_sub_group_id' => 112,
            ],
            [
                'reference_number' => '11/2/3',
                'name' => 'Discharge Ors / Ratings / Discharge Officer Cadet',
                'index_sub_group_id' => 112,
            ],
            [
                'reference_number' => '11/2/4',
                'name' => 'Discharge Certificates / TTR Form 41’s',
                'index_sub_group_id' => 112,
            ],
            [
                'reference_number' => '11/2/5',
                'name' => 'Re-Instatement',
                'index_sub_group_id' => 112,
            ],

            //113. Promotions

            [
                'reference_number' => '11/3/1',
                'name' => 'Promotion Procedures',
                'index_sub_group_id' => 113,
            ],
            [
                'reference_number' => '11/3/2',
                'name' => 'Promotion - Officers',
                'index_sub_group_id' => 113,
            ],
            [
                'reference_number' => '11/3/3',
                'name' => 'Promotion – Other Ranks / Ratings',
                'index_sub_group_id' => 113,
            ],
            [
                'reference_number' => '11/3/4',
                'name' => 'Lieutenant to Captain Exams',
                'index_sub_group_id' => 113,
            ],

            //114. Personal Files TTR Officers

            [
                'reference_number' => '11/4/0',
                'name' => 'TTR Officers',
                'index_sub_group_id' => 114,
            ],

            //115. Personal Files TTCG Officers

            [
                'reference_number' => '11/5/0',
                'name' => 'CG Officers',
                'index_sub_group_id' => 115,
            ],

            //116. Transfer

            [
                'reference_number' => '11/6/1',
                'name' => 'Inter Unit Transfers (CG to TTR or TTR to CG) / AG',
                'index_sub_group_id' => 116,
            ],
            [
                'reference_number' => '11/6/2',
                'name' => 'Transfer / Attachments to & from other Gov’t Departments / DEFTIS',
                'index_sub_group_id' => 116,
            ],
            [
                'reference_number' => '11/6/3',
                'name' => 'Attachment / Detachment / Change of Coys (Inter Bn)',
                'index_sub_group_id' => 116,
            ],
            [
                'reference_number' => '11/6/4',
                'name' => 'Assignment of Ministry of National Security',
                'index_sub_group_id' => 116,
            ],
            [
                'reference_number' => '11/6/5',
                'name' => 'Attachment of Foreign Troops / Nigerian Pan',
                'index_sub_group_id' => 116,
            ],

        ];

        foreach ($establishmentSubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}
