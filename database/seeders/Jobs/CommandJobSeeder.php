<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class CommandJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            [
                'name' => 'Commanding Officer of the Regiment',
                'short_name' => 'COTTR',
                'job_category_id' => 3,
            ],
            [
                'name' => 'Brigade 2IC',
                'short_name' => 'Brig 2IC',
                'job_category_id' => 3,
            ],
            [
                'name' => 'Commanding Officer',
                'short_name' => 'CO',
                'job_category_id' => 3,
            ],
            [
                'name' => 'Battalion 2IC',
                'short_name' => 'BN 2IC',
                'job_category_id' => 3,
            ],
            [
                'name' => 'Officer Commanding',
                'short_name' => 'OC',
                'job_category_id' => 3,
            ],
            [
                'name' => 'Company 2IC',
                'short_name' => 'Coy 2IC',
                'job_category_id' => 3,
            ],
            [
                'name' => 'Platoon Commander',
                'short_name' => 'Pl Comd',
                'job_category_id' => 3,
            ],
            //            Command - OR
            [
                'name' => 'Platoon Sergeant',
                'short_name' => 'Pl Sgt',
                'job_category_id' => 3,
            ],
            [
                'name' => 'Section Commander',
                'short_name' => 'Sect Comd',
                'job_category_id' => 3,
            ],
            [
                'name' => 'Section 2IC',
                'short_name' => 'Sect 2IC',
                'job_category_id' => 3,
            ],
            [
                'name' => 'Team Leader',
                'short_name' => 'TM Ldr',
                'job_category_id' => 3,
            ],
        ];

        foreach ($jobs as $job) {
            Job::query()->create([
                'name' => $job['name'],
                'short_name' => $job['short_name'],
                'job_category_id' => $job['job_category_id'],
            ]);
        }
    }
}
