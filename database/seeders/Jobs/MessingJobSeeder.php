<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class MessingJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $jobs = [
            [
                'name' => 'Messing Officer',
                'short_name' => 'Messing Offr',
                'job_category_id' => 11,
            ],
            [
                'name' => 'Ration Stores Warrant Officer',
                'short_name' => 'Ration Stores WO',
                'job_category_id' => 11,
            ],
            [
                'name' => 'Regimental Master Cook',
                'short_name' => 'Regimental Master Cook',
                'job_category_id' => 11,
            ],
            [
                'name' => 'Regimental Mess Manager',
                'short_name' => 'Regimental Mess Manager',
                'job_category_id' => 11,
            ],
            [
                'name' => 'Master Cook',
                'short_name' => 'Master Cook',
                'job_category_id' => 11,
            ],
            [
                'name' => 'Catering Senior NCO',
                'short_name' => 'Catering SNCO',
                'job_category_id' => 11,
            ],
            [
                'name' => 'Cookhouse Senior NCO',
                'short_name' => 'Cookhouse SNCO',
                'job_category_id' => 11,
            ],
            [
                'name' => 'Dinning Hall NCO',
                'short_name' => 'Dinning Hall NCO',
                'job_category_id' => 11,
            ],
            [
                'name' => 'Cook',
                'short_name' => 'Cook',
                'job_category_id' => 11,
            ],
            [
                'name' => 'Issuing Sergeant',
                'short_name' => null,
                'job_category_id' => 11,
            ],
            [
                'name' => 'Mess Manager',
                'short_name' => null,
                'job_category_id' => 11,
            ],
            [
                'name' => 'Mess Steward',
                'short_name' => null,
                'job_category_id' => 11,
            ],
            [
                'name' => 'Ration Stores NCO',
                'short_name' => null,
                'job_category_id' => 11,
            ],
            [
                'name' => 'Regiment Chief Steward',
                'short_name' => null,
                'job_category_id' => 11,
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
