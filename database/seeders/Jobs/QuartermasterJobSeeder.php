<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class QuartermasterJobSeeder extends Seeder
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
                'name' => 'Warehousing SNCO',
                'short_name' => null,
                'job_category_id' => 16,
            ],
            [
                'name' => 'Quartermaster Sergeant',
                'short_name' => 'QM Sgt',
                'job_category_id' => 16,
            ],
            [
                'name' => 'Clothing & Equipment SNCO',
                'short_name' => null,
                'job_category_id' => 16,
            ],
            [
                'name' => 'Disposals SNCO',
                'short_name' => null,
                'job_category_id' => 16,
            ],
            [
                'name' => 'Expendables SNCO',
                'short_name' => null,
                'job_category_id' => 16,
            ],
            [
                'name' => 'NCO IC Stores',
                'short_name' => null,
                'job_category_id' => 16,
            ],
            [
                'name' => 'Storeman',
                'short_name' => 'Storeman',
                'job_category_id' => 16,
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
