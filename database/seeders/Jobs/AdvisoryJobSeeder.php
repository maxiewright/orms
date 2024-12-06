<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class AdvisoryJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'name' => 'Command Sergeant Major',
                'short_name' => 'Comd',
                'job_category_id' => 2,
            ],
            [
                'name' => 'Regimental Sergeant Major',
                'short_name' => 'RSM',
                'job_category_id' => 2,
            ],
            [
                'name' => 'Company Sergeant Major',
                'short_name' => 'CSM',
                'job_category_id' => 2,
            ],
            [
                'name' => 'Detachment Sergeant Major',
                'short_name' => 'DSM',
                'job_category_id' => 2,
            ],
            [
                'name' => 'Field Squadron Sergeant Major',
                'short_name' => 'FSSM',
                'job_category_id' => 2,
            ],
            [
                'name' => 'Sergeant Major of the Special Forces',
                'short_name' => 'SFSM',
                'job_category_id' => 2,
            ],
            [
                'name' => 'Band Sergeant Major',
                'short_name' => 'BSM',
                'job_category_id' => 2,
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
