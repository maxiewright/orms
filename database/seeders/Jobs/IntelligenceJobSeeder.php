<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class IntelligenceJobSeeder extends Seeder
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
                'name' => 'General Staff 2 - Intelligence',
                'short_name' => 'G2',
                'job_category_id' => 7,
            ],
            [
                'name' => 'Support Staff 2 - Intelligence',
                'short_name' => 'S2',
                'job_category_id' => 7,
            ],
            [
                'name' => 'Records & Investigation Senior NCO',
                'short_name' => 'Records & Investigation SNCO',
                'job_category_id' => 7,
            ],
            [
                'name' => 'Intelligence Warrant Officer',
                'short_name' => 'Intel WO',
                'job_category_id' => 7,
            ],
            [
                'name' => 'Intelligence Senior NCO',
                'short_name' => 'Intel SNCO',
                'job_category_id' => 7,
            ],
            [
                'name' => 'Investigation Sergeant',
                'short_name' => null,
                'job_category_id' => 7,
            ],
            [
                'name' => 'Military Investigators',
                'short_name' => null,
                'job_category_id' => 7,
            ],
            [
                'name' => 'Intelligence Operator',
                'short_name' => 'Intel Operator',
                'job_category_id' => 7,
            ],

            [
                'name' => 'Intelligence analyst',
                'short_name' => 'Intel Analyst',
                'job_category_id' => 7,
            ],

            //            Provost

            [
                'name' => 'Provost',
                'short_name' => null,
                'job_category_id' => 7,
            ],
            [
                'name' => 'Provost Sergeant',
                'short_name' => null,
                'job_category_id' => 7,
            ],
            [
                'name' => 'Provost SNCO',
                'short_name' => null,
                'job_category_id' => 7,
            ],
            [
                'name' => 'Provost Warrant Officer',
                'short_name' => null,
                'job_category_id' => 7,
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
