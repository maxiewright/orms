<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RHQDepartmentsSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            [
                'company_id' => '1',
                'department_id' => '1',
            ],
            [
                'company_id' => '1',
                'department_id' => '2',
            ],
            [
                'company_id' => '1',
                'department_id' => '3',
            ],
            [
                'company_id' => '1',
                'department_id' => '4',
            ],
            [
                'company_id' => '1',
                'department_id' => '5',
            ],            [
                'company_id' => '1',
                'department_id' => '6',
            ],
            [
                'company_id' => '1',
                'department_id' => '7',
            ],
            [
                'company_id' => '1',
                'department_id' => '8',
            ],
            [
                'company_id' => '1',
                'department_id' => '9',
            ],
            [
                'company_id' => '1',
                'department_id' => '10',
            ],
            [
                'company_id' => '1',
                'department_id' => '11',
            ],
        ];

        DB::table('company_department')
            ->insert($departments);
    }
}
