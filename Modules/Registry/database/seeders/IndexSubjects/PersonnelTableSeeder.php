<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class PersonnelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $personnelSubjects = [
            //101. Civilian Employees
            [
                'reference_number' => '10/1/1',
                'name' => 'Daily Paid at DFHQ',
                'index_sub_group_id' => 101,
            ],
            [
                'reference_number' => '10/1/2',
                'name' => 'Monthly Paid',
                'index_sub_group_id' => 101,
            ],

            //102. Classification

            [
                'reference_number' => '10/2/1',
                'name' => 'Annual Classification',
                'index_sub_group_id' => 102,
            ],
            [
                'reference_number' => '10/2/2',
                'name' => 'Trade Classification / Academic Qualifications',
                'index_sub_group_id' => 102,
            ],

            //103. Confidential Reports

            [
                'reference_number' => '10/3/1',
                'name' => 'Officers Confidential',
                'index_sub_group_id' => 103,
            ],
            [
                'reference_number' => '10/3/2',
                'name' => 'Other Ranks / Ratings / Draft Testimonials / Performance Appraisals / PFs',
                'index_sub_group_id' => 103,
            ],
            [
                'reference_number' => '10/3/3',
                'name' => 'Administrative Reports / Quarterly Activity Report / Priority Listing',
                'index_sub_group_id' => 103,
            ],
            [
                'reference_number' => '10/3/4',
                'name' => 'Curriculum / Resume Officers / Designation Offrs',
                'index_sub_group_id' => 103,
            ],
            [
                'reference_number' => '10/3/5',
                'name' => 'Intelligence Reports',
                'index_sub_group_id' => 103,
            ],
            [
                'reference_number' => '10/3/6',
                'name' => 'Occurrence Reports',
                'index_sub_group_id' => 103,
            ],

            //104. Discipline Matters

            [
                'reference_number' => '10/4/1',
                'name' => 'Outstanding Debts',
                'index_sub_group_id' => 104,
            ],
            [
                'reference_number' => '10/4/2',
                'name' => 'Conduct / Disciplinary Matters - Officers',
                'index_sub_group_id' => 104,
            ],
            [
                'reference_number' => '10/4/3',
                'name' => 'Complaint and Disturbances – DF Personnel / Complaint & Disturbances – Civilian',
                'index_sub_group_id' => 104,
            ],
            [
                'reference_number' => '10/4/4',
                'name' => 'Return of Punishment',
                'index_sub_group_id' => 104,
            ],
            [
                'reference_number' => '10/4/5',
                'name' => 'Unusual Occurrences',
                'index_sub_group_id' => 104,
            ],
            [
                'reference_number' => '10/4/6',
                'name' => 'Use of Illegal Drugs / Drug Testing / Certificate of Analysis',
                'index_sub_group_id' => 104,
            ],
            [
                'reference_number' => '10/4/7',
                'name' => 'Redress – Captain R Kelshall',
                'index_sub_group_id' => 104,
            ],
            [
                'reference_number' => '10/4/8',
                'name' => 'Redress – Major A Dalip',
                'index_sub_group_id' => 104,
            ],
            [
                'reference_number' => '10/4/9',
                'name' => 'Petitions / Ex-Pte Ramesh Raghoo (8050)',
                'index_sub_group_id' => 104,
            ],

            //. Court Martial

            [
                'reference_number' => '10/5/1',
                'name' => 'Court Martial',
                'index_sub_group_id' => 105,
            ],
            [
                'reference_number' => '10/5/2',
                'name' => 'Captain T King (Whole file placed in Officer’s PF 12/11/97)',
                'index_sub_group_id' => 105,
            ],
            [
                'reference_number' => '10/5/3',
                'name' => '4389 Cpl Joseph R – re-enlisted',
                'index_sub_group_id' => 105,
            ],
            [
                'reference_number' => '10/5/4',
                'name' => 'Lt LE Chandler / Record of Proceedings – Lt LE Chandler',
                'index_sub_group_id' => 105,
            ],

            //106. Dress

            [
                'reference_number' => '10/6/1',
                'name' => 'Dress – Policy',
                'index_sub_group_id' => 106,
            ],
            [
                'reference_number' => '10/6/2',
                'name' => 'Dress Regulations – TTR',
                'index_sub_group_id' => 106,
            ],
            [
                'reference_number' => '10/6/3',
                'name' => 'Dress Regulations – TTCG',
                'index_sub_group_id' => 106,
            ],

            //107. Welfare and Entertainment

            [
                'reference_number' => '10/7/1',
                'name' => 'Request for Liquor for Functions',
                'index_sub_group_id' => 107,
            ],
            [
                'reference_number' => '10/7/2',
                'name' => 'Officers Mess – DFHQ / Carols by Candlelight / CDS Cocktails',
                'index_sub_group_id' => 107,
            ],
            [
                'reference_number' => '10/7/3',
                'name' => 'Officers Mess – Teteron Barracks / Officers Mess – 1TTR / 2TTR',
                'index_sub_group_id' => 107,
            ],
            [
                'reference_number' => '10/7/4',
                'name' => 'Officers Mess – Staubles Bay',
                'index_sub_group_id' => 107,
            ],
            [
                'reference_number' => '10/7/5',
                'name' => 'WO’s & Sgt’s Mess - Teteron Barracks',
                'index_sub_group_id' => 107,
            ],
            [
                'reference_number' => '10/7/6',
                'name' => 'WO’s & Sgt’s Mess – DFHQ',
                'index_sub_group_id' => 107,
            ],
            [
                'reference_number' => '10/7/7',
                'name' => 'Senior Rates Mess – Staubles Bay',
                'index_sub_group_id' => 107,
            ],
            [
                'reference_number' => '10/7/8',
                'name' => 'DFHQ Canteen / ‘D’ Club',
                'index_sub_group_id' => 107,
            ],
            [
                'reference_number' => '10/7/9',
                'name' => 'Combine Services Officers Mess / Armistice Dinner',
                'index_sub_group_id' => 107,
            ],
            [
                'reference_number' => '10/7/10',
                'name' => 'Welfare Activity within the Force / Forecast of Events / Children’s Xmas Party / Welfare Activities – 1TTR/2TTR/SSB/TTR/DFHQ',
                'index_sub_group_id' => 107,
            ],
            [
                'reference_number' => '10/7/11',
                'name' => 'Compensation/Assistance DF Personnel/Family Support Group',
                'index_sub_group_id' => 107,
            ],
            [
                'reference_number' => '10/7/12',
                'name' => 'Millennium Ball/National Security Carnival Brunch',
                'index_sub_group_id' => 107,
            ],
            [
                'reference_number' => '10/7/13',
                'name' => 'All Ranks Concert/Ball',
                'index_sub_group_id' => 107,
            ],

            //108. Insurance

            [
                'reference_number' => '10/8/1',
                'name' => 'Group Plan',
                'index_sub_group_id' => 108,
            ],
            [
                'reference_number' => '10/8/2',
                'name' => 'Aircraft',
                'index_sub_group_id' => 108,
            ],
            [
                'reference_number' => '10/8/3',
                'name' => 'Vehicles',
                'index_sub_group_id' => 108,
            ],
            [
                'reference_number' => '10/8/4',
                'name' => 'Boats',
                'index_sub_group_id' => 108,
            ],
            [
                'reference_number' => '10/8/5',
                'name' => 'General Insurance',
                'index_sub_group_id' => 108,
            ],

            //109. Leave

            [
                'reference_number' => '10/9/1',
                'name' => 'Officers Leave',
                'index_sub_group_id' => 109,
            ],
            [
                'reference_number' => '10/9/2',
                'name' => 'Other Ranks / Ratings',
                'index_sub_group_id' => 109,
            ],

            //1010. Recommendation / Commendation

            [
                'reference_number' => '10/10/1',
                'name' => 'Visa Letters to Embassies / High Commission',
                'index_sub_group_id' => 1010,
            ],
            [
                'reference_number' => '10/10/2',
                'name' => 'Letter of Thanks / Recommendation / Commendation to Personnel',
                'index_sub_group_id' => 1010,
            ],
            [
                'reference_number' => '10/10/3',
                'name' => 'Draft Agreement between T&T & People’s Republic of China',
                'index_sub_group_id' => 1010,
            ],
            [
                'reference_number' => '10/10/4',
                'name' => 'Donation / Gift to Defence Force',
                'index_sub_group_id' => 1010,
            ],

            //1011. Legal Matters

            [
                'reference_number' => '10/11/1',
                'name' => 'High Court Action Against Members of TTDF / High Court Action – Vehicle Accident 3 TTR 92',
                'index_sub_group_id' => 1011,
            ],
            [
                'reference_number' => '10/11/2',
                'name' => 'Magistrate’s Court',
                'index_sub_group_id' => 1011,
            ],
            [
                'reference_number' => '10/11/3',
                'name' => 'MOU’s & Legal Frameworks',
                'index_sub_group_id' => 1011,
            ],
            [
                'reference_number' => '10/11/4',
                'name' => 'International Criminal Court',
                'index_sub_group_id' => 1011,
            ],

        ];

        foreach ($personnelSubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}
