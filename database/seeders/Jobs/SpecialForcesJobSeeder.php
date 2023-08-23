<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class SpecialForcesJobSeeder extends Seeder
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
                'name' => 'Radio Operator',
                'short_name' => null,
                'job_category_id' => 17,
            ],
            [
                'name' => 'Team Commander',
                'short_name' => null,
                'job_category_id' => 17,
            ],
            [
                'name' => 'Operations Sergeant',
                'short_name' => null,
                'job_category_id' => 17,
            ],
            [
                'name' => 'Recorder',
                'short_name' => null,
                'job_category_id' => 17,
            ],
            [
                'name' => 'Scout',
                'short_name' => null,
                'job_category_id' => 17,
            ],
            [
                'name' => 'Navigator',
                'short_name' => null,
                'job_category_id' => 17,
            ],
            [
                'name' => 'Training Sergeant',
                'short_name' => null,
                'job_category_id' => 17,
            ],
            [
                'name' => 'Sniper',
                'short_name' => null,
                'job_category_id' => 17,
            ],
            [
                'name' => 'Spotter',
                'short_name' => null,
                'job_category_id' => 17,
            ],
            [
                'name' => 'Breacher',
                'short_name' => null,
                'job_category_id' => 17,
            ],
            [
                'name' => 'Entryman',
                'short_name' => null,
                'job_category_id' => 17,
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
