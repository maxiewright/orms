<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class MaintenanceJobSeeder extends Seeder
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
                'name' => 'Area Supervisor',
                'short_name' => null,
                'job_category_id' => 9,
            ],
            [
                'name' => 'Health, Safety, Security and Environment Senior NCO',
                'short_name' => 'HSSE SNCO',
                'job_category_id' => 9,
            ],
            [
                'name' => 'Maintenance Senior NCO',
                'short_name' => 'Maintenance SNCO',
                'job_category_id' => 9,
            ],
            [
                'name' => 'Health, Safety, Security and Environment Warrant Officer',
                'short_name' => 'HSE WO',
                'job_category_id' => 9,
            ],
            [
                'name' => 'Health, Safety, Security and Environment Personnel',
                'short_name' => 'HSE Rep',
                'job_category_id' => 9,
            ],
            [
                'name' => 'Maintenance NCO',
                'short_name' => 'Maintenance NCO',
                'job_category_id' => 9,
            ],
            [
                'name' => 'NCO IC Sanitation',
                'short_name' => null,
                'job_category_id' => 9,
            ],
            [
                'name' => 'R&D Safety Staff Sergeant',
                'short_name' => null,
                'job_category_id' => 9,
            ],
            [
                'name' => 'Tool Maintenance',
                'short_name' => null,
                'job_category_id' => 9,
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
