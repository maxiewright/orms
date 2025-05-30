<?php

namespace Modules\Registry\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Registry\Models\RegistryIndex\IndexSubGroup;

class IndexSubGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subGroups = [
            //1.	Accommodation
            [
                'id' => 11,
                'reference_number' => '1/1',
                'name' => 'Camps',
                'index_group_id' => 1,
            ],
            [
                'id' => 12,
                'reference_number' => '1/2',
                'name' => 'Housing',
                'index_group_id' => 1,
            ],
            //2.	Administration
            [
                'id' => 21,
                'reference_number' => '2/1',
                'name' => 'Accidents',
                'index_group_id' => 2,
            ],
            [
                'id' => 22,
                'reference_number' => '2/2',
                'name' => 'Chaplain',
                'index_group_id' => 2,
            ],
            [
                'id' => 23,
                'reference_number' => '2/3',
                'name' => 'Arms / Ammunition',
                'index_group_id' => 2,
            ],
            [
                'id' => 24,
                'reference_number' => '2/4',
                'name' => 'Assistance to Civilian Organization',
                'index_group_id' => 2,
            ],
            [
                'id' => 25,
                'reference_number' => '2/5',
                'name' => 'Crisis / Disasters',
                'index_group_id' => 2,
            ],
            [
                'id' => 26,
                'reference_number' => '2/6',
                'name' => 'Communication',
                'index_group_id' => 2,
            ],
            [
                'id' => 27,
                'reference_number' => '2/7',
                'name' => 'Elections',
                'index_group_id' => 2,
            ],
            [
                'id' => 28,
                'reference_number' => '2//8',
                'name' => 'Equipment / Stationery',
                'index_group_id' => 2,
            ],
            [
                'id' => 29,
                'reference_number' => '2//9',
                'name' => 'Survey',
                'index_group_id' => 2,
            ],
            [
                'id' => 210,
                'reference_number' => '2//10',
                'name' => 'Inspection',
                'index_group_id' => 2,
            ],
            [
                'id' => 211,
                'reference_number' => '2//11',
                'name' => 'Invitations',
                'index_group_id' => 2,
            ],
            [
                'id' => 212,
                'reference_number' => '2//12',
                'name' => 'Medals / Awards / Flags',
                'index_group_id' => 2,
            ],
            [
                'id' => 213,
                'reference_number' => '2//13',
                'name' => 'Order / Interviews',
                'index_group_id' => 2,
            ],
            [
                'id' => 214,
                'reference_number' => '2/14',
                'name' => 'Policy / Regulations',
                'index_group_id' => 2,
            ],
            [
                'id' => 215,
                'reference_number' => '2/15',
                'name' => 'Visits',
                'index_group_id' => 2,
            ],
            [
                'id' => 216,
                'reference_number' => '2/16',
                'name' => 'Command',
                'index_group_id' => 2,
            ],
            [
                'id' => 217,
                'reference_number' => '2/17',
                'name' => 'Government Institution',
                'index_group_id' => 2,
            ],
            [
                'id' => 218,
                'reference_number' => '2/18',
                'name' => 'Publications / Circular Memorandum',
                'index_group_id' => 2,
            ],
            [
                'id' => 219,
                'reference_number' => '2/19',
                'name' => 'Vehicles / Military ID / Military Drivers Permit',
                'index_group_id' => 2,
            ],
            [
                'id' => 220,
                'reference_number' => '2/20',
                'name' => 'Agriculture',
                'index_group_id' => 2,
            ],
            [
                'id' => 221,
                'reference_number' => '2/21',
                'name' => 'Private',
                'index_group_id' => 2,
            ],
            //3.	Boards
            [
                'id' => 31,
                'reference_number' => '3/1',
                'name' => 'Board of Inquiry - Regiment',
                'index_group_id' => 3,
            ],
            [
                'id' => 32,
                'reference_number' => '3/2',
                'name' => 'Board of Inquiry - Coast Guard',
                'index_group_id' => 3,
            ],
            [
                'id' => 33,
                'reference_number' => '3/3',
                'name' => 'Commission Board',
                'index_group_id' => 3,
            ],
            [
                'id' => 34,
                'reference_number' => '3/4',
                'name' => 'Board of Survey',
                'index_group_id' => 3,
            ],
            //4.	Conferences/Committee/meetings
            [
                'id' => 41,
                'reference_number' => '4/1',
                'name' => 'Foreign',
                'index_group_id' => 4,
            ],
            [
                'id' => 42,
                'reference_number' => '4/2',
                'name' => 'Local',
                'index_group_id' => 4,
            ],
            //5.	Funerals/War Graves
            [
                'id' => 51,
                'reference_number' => '5/1',
                'name' => 'Military Funeral',
                'index_group_id' => 5,
            ],
            [
                'id' => 52,
                'reference_number' => '5/2',
                'name' => 'State Funerals',
                'index_group_id' => 5,
            ],
            [
                'id' => 53,
                'reference_number' => '5/3',
                'name' => 'War graves',
                'index_group_id' => 5,
            ],

            //6.	Government Officials
            [
                'id' => 61,
                'reference_number' => '6/1',
                'name' => 'Head of State/Ministries',
                'index_group_id' => 6,
            ],
            [
                'id' => 62,
                'reference_number' => '6/2',
                'name' => 'Ambassador / High Commission',
                'index_group_id' => 6,
            ],
            //7.	Financial & Accounting Matters
            [
                'id' => 71,
                'reference_number' => '7/1',
                'name' => 'Estimates',
                'index_group_id' => 7,
            ],
            [
                'id' => 72,
                'reference_number' => '7/2',
                'name' => 'Allowance',
                'index_group_id' => 7,
            ],
            [
                'id' => 73,
                'reference_number' => '7/3',
                'name' => 'Pay Matters',
                'index_group_id' => 7,
            ],
            [
                'id' => 74,
                'reference_number' => '7/4',
                'name' => 'Tenders Board Request / Approval',
                'index_group_id' => 7,
            ],
            [
                'id' => 75,
                'reference_number' => '7/5',
                'name' => 'Funds',
                'index_group_id' => 7,
            ],

            //8.	Operations
            [
                'id' => 81,
                'reference_number' => '8/1',
                'name' => 'Exercise',
                'index_group_id' => 8,
            ],
            [
                'id' => 82,
                'reference_number' => '8/2',
                'name' => 'Patrols',
                'index_group_id' => 8,
            ],
            //9.	Parades
            [
                'id' => 91,
                'reference_number' => '9/1',
                'name' => 'Internal',
                'index_group_id' => 9,
            ],
            [
                'id' => 92,
                'reference_number' => '9/2',
                'name' => 'National / Ceremonial',
                'index_group_id' => 9,
            ],
            //10.	Personnel
            [
                'id' => 101,
                'reference_number' => '10/1',
                'name' => 'Civilian Employees',
                'index_group_id' => 10,
            ],
            [
                'id' => 102,
                'reference_number' => '10/2',
                'name' => 'Classifications',
                'index_group_id' => 10,
            ],
            [
                'id' => 103,
                'reference_number' => '10/3',
                'name' => 'Confidential Reports',
                'index_group_id' => 10,
            ],
            [
                'id' => 104,
                'reference_number' => '10/4',
                'name' => 'Disciplinary Matters',
                'index_group_id' => 10,
            ],
            [
                'id' => 105,
                'reference_number' => '10/5',
                'name' => 'Court Martial',
                'index_group_id' => 10,
            ],
            [
                'id' => 106,
                'reference_number' => '10/6',
                'name' => 'Dress',
                'index_group_id' => 10,
            ],
            [
                'id' => 107,
                'reference_number' => '10/7',
                'name' => 'Welfare & Entertainment',
                'index_group_id' => 10,
            ],
            [
                'id' => 108,
                'reference_number' => '10/8',
                'name' => 'Insurance',
                'index_group_id' => 10,
            ],
            [
                'id' => 109,
                'reference_number' => '10/9',
                'name' => 'Leave',
                'index_group_id' => 10,
            ],
            [
                'id' => 1010,
                'reference_number' => '10/10',
                'name' => 'Recommendation / Commendation / Donations in the Defence Force',
                'index_group_id' => 10,
            ],
            [
                'id' => 1011,
                'reference_number' => '10/11',
                'name' => 'Attendance to Civil Courts',
                'index_group_id' => 10,
            ],
            //11.	Establishment
            [
                'id' => 111,
                'reference_number' => '11/1',
                'name' => 'Recruitment',
                'index_group_id' => 11,
            ],
            [
                'id' => 112,
                'reference_number' => '11/2',
                'name' => 'Discharge / Retirement / Resignation',
                'index_group_id' => 11,
            ],
            [
                'id' => 113,
                'reference_number' => '11/3',
                'name' => 'Promotions',
                'index_group_id' => 11,
            ],
            [
                'id' => 114,
                'reference_number' => '11/4',
                'name' => 'Personal File - TTR Officers',
                'index_group_id' => 11,
            ],
            [
                'id' => 115,
                'reference_number' => '11/5',
                'name' => 'Personal File - TTCG Officers',
                'index_group_id' => 11,
            ],
            [
                'id' => 116,
                'reference_number' => '11/6',
                'name' => 'Transfers',
                'index_group_id' => 11,
            ],
            //12.	Training
            [
                'id' => 121,
                'reference_number' => '12/1',
                'name' => 'Foreign Training',
                'index_group_id' => 12,
            ],
            [
                'id' => 122,
                'reference_number' => '12/2',
                'name' => 'Local Training',
                'index_group_id' => 12,
            ],
            //13.	Sports
            [
                'id' => 131,
                'reference_number' => '13/1',
                'name' => 'Local / Regional / International',
                'index_group_id' => 13,
            ],
            //14.	Security
            [
                'id' => 141,
                'reference_number' => '14/1',
                'name' => 'Government Buildings',
                'index_group_id' => 14,
            ],
            [
                'id' => 142,
                'reference_number' => '14/2',
                'name' => 'Guards',
                'index_group_id' => 14,
            ],
            [
                'id' => 143,
                'reference_number' => '14/3',
                'name' => 'Caribbean Security (Regional Security System)',
                'index_group_id' => 14,
            ],
            [
                'id' => 144,
                'reference_number' => '14/4',
                'name' => 'Caribbean Island National Security Conference (CINSEC)',
                'index_group_id' => 14,
            ],
            //15.	Volunteer Defence Force
            [
                'id' => 151,
                'reference_number' => '15/1',
                'name' => 'Regiment',
                'index_group_id' => 15,
            ],
            [
                'id' => 152,
                'reference_number' => '15/2',
                'name' => 'Coast Guard',
                'index_group_id' => 15,
            ],
            [
                'id' => 153,
                'reference_number' => '15/3',
                'name' => 'Air Guard',
                'index_group_id' => 15,
            ],
            //16.	Medical & Dental
            [
                'id' => 161,
                'reference_number' => '16/1',
                'name' => 'Medical Officers',
                'index_group_id' => 16,
            ],
            [
                'id' => 162,
                'reference_number' => '16/2',
                'name' => 'Medical Matters',
                'index_group_id' => 16,
            ],
            [
                'id' => 163,
                'reference_number' => '16/3',
                'name' => 'Medical Board',
                'index_group_id' => 16,
            ],

        ];
        foreach ($subGroups as $subGroup) {
            IndexSubGroup::query()->create($subGroup);
        }
    }
}
