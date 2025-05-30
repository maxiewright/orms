<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class FuneralsAndWarGravesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $funeralAndWarGravesSubjects = [
            //51.	Military Funerals
            [
                'reference_number' => '5/1/1',
                'name' => 'Military Funerals (Policy)',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/2',
                'name' => '4214 Sgt Rogers G',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/3',
                'name' => '8099 Pte Cozier Kurt',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/4',
                'name' => 'Pte Salandy R',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/5',
                'name' => '4930 Pte Charles M',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/6',
                'name' => '3625 Sgt Ramsey C',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/7',
                'name' => '3886 Sgt Charles CS',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/8',
                'name' => '8670 Pte Lake C',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/9',
                'name' => '783 PO Parasram S',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/10',
                'name' => 'Lt A Reid',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/11',
                'name' => 'FCPO Donawa',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/12',
                'name' => '8623 Pte Chaitoo T',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/13',
                'name' => '8745 Pte Charles R',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/14',
                'name' => 'FR E Mahabir',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/15',
                'name' => 'Pte Bostic C',
                'index_sub_group_id' => 51,
            ],
            [
                'reference_number' => '5/1/16',
                'name' => '4495 Pte Wight D',
                'index_sub_group_id' => 51,
            ],

            //52.	State Funerals

            [
                'reference_number' => '5/2/1',
                'name' => 'State Funerals – Policy',
                'index_sub_group_id' => 52,
            ],

            //52.	War Graves

            [
                'reference_number' => '5/3/1',
                'name' => 'Commonwealth War Graves',
                'index_sub_group_id' => 53,
            ],

        ];
        foreach ($funeralAndWarGravesSubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}
