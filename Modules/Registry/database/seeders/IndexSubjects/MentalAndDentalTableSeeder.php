<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class MentalAndDentalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $mentalAndDentalSubjects = [
            //161. Medical
            [
                'reference_number' => '16/1/1',
                'name' => 'Duties DFMO',
                'index_sub_group_id' => 161,
            ],
            [
                'reference_number' => '16/1/2',
                'name' => 'Dr V Pooran',
                'index_sub_group_id' => 161,
            ],
            [
                'reference_number' => '16/1/3',
                'name' => 'Dr AW Charles',
                'index_sub_group_id' => 161,
            ],
            [
                'reference_number' => '16/1/4',
                'name' => 'Dr F Bonterre – Psychiatrist',
                'index_sub_group_id' => 161,
            ],
            [
                'reference_number' => '16/1/5',
                'name' => 'Dr R Tom Pack',
                'index_sub_group_id' => 161,
            ],
            [
                'reference_number' => '16/1/6',
                'name' => 'Dental Services',
                'index_sub_group_id' => 161,
            ],
            [
                'reference_number' => '16/1/7',
                'name' => 'Dr M Trotman	',
                'index_sub_group_id' => 161,
            ],
            [
                'reference_number' => '16/1/8',
                'name' => 'Dr I Dowlat',
                'index_sub_group_id' => 161,
            ],

            //162. Medical Matters

            [
                'reference_number' => '16/2/1',
                'name' => 'Medical Training',
                'index_sub_group_id' => 162,
            ],
            [
                'reference_number' => '16/2/2',
                'name' => 'Assignment of a Nurse',
                'index_sub_group_id' => 162,
            ],
            [
                'reference_number' => '16/2/3',
                'name' => 'Pharmacist',
                'index_sub_group_id' => 162,
            ],
            [
                'reference_number' => '16/2/4',
                'name' => 'Families Clinic',
                'index_sub_group_id' => 162,
            ],
            [
                'reference_number' => '16/2/5',
                'name' => 'Refund of Medical and Dental Expenses',
                'index_sub_group_id' => 162,
            ],
            [
                'reference_number' => '16/2/6',
                'name' => 'Analysis Machine Equipment/Medical Equipment',
                'index_sub_group_id' => 162,
            ],
            [
                'reference_number' => '16/2/7',
                'name' => 'Medical Treatment for TTDF Personnel',
                'index_sub_group_id' => 162,
            ],
            [
                'reference_number' => '16/2/8',
                'name' => 'Medical Examination Report/PULEEMS',
                'index_sub_group_id' => 162,
            ],
            [
                'reference_number' => '16/2/9',
                'name' => 'Proposals for Psychological Evaluation',
                'index_sub_group_id' => 162,
            ],
            [
                'reference_number' => '16/2/10',
                'name' => 'Military Hospital',
                'index_sub_group_id' => 162,
            ],

            //163. Medical Board

            [
                'reference_number' => '16/3/1',
                'name' => 'Medical Board',
                'index_sub_group_id' => 163,
            ],

        ];

        foreach ($mentalAndDentalSubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}
