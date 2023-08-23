<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class LogsAndFinanceJobSeeder extends Seeder
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
                'name' => 'General Staff 4 - Logistics and Finance',
                'short_name' => 'G4',
                'job_category_id' => 8,
            ],
            [
                'name' => 'Support Staff 4 - Logistics and Finance',
                'short_name' => 'S4',
                'job_category_id' => 8,
            ],
            [
                'name' => 'Purchasing Sergeant',
                'short_name' => null,
                'job_category_id' => 8,
            ],
            [
                'name' => 'Logistics Senior NCO',
                'short_name' => 'Logs SNCO',
                'job_category_id' => 8,
            ],
            [
                'name' => 'Supply & Financial Management Clerk',
                'short_name' => null,
                'job_category_id' => 8,
            ],
            [
                'name' => 'Auditing Sergeant',
                'short_name' => null,
                'job_category_id' => 8,
            ],
            [
                'name' => 'Procurement Warrant Officer',
                'short_name' => null,
                'job_category_id' => 8,
            ],
            [
                'name' => 'Finance and Auditing Warrant Officer',
                'short_name' => null,
                'job_category_id' => 8,
            ],
            [
                'name' => 'Finance Sergeant',
                'short_name' => null,
                'job_category_id' => 8,
            ],
            [
                'name' => 'Logistics Warrant Officer',
                'short_name' => null,
                'job_category_id' => 8,
            ],
            [
                'name' => 'Procurement Clerk',
                'short_name' => null,
                'job_category_id' => 8,
            ],
            [
                'name' => 'SNCO IC Purchasing Staff (PMOSS)',
                'short_name' => null,
                'job_category_id' => 8,
            ],
            [
                'name' => 'Logistics SNCO',
                'short_name' => null,
                'job_category_id' => 8,
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
