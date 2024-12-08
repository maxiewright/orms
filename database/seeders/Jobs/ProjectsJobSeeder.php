<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class ProjectsJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'name' => 'General Staff 5 - Projects',
                'short_name' => 'G5',
                'job_category_id' => 15,
            ],
            [
                'name' => 'Support Staff 5 - Projects',
                'short_name' => 'S5',
                'job_category_id' => 15,
            ],
            [
                'name' => 'Projects Warrant Officer',
                'short_name' => 'Projects WO',
                'job_category_id' => 15,
            ],
            [
                'name' => 'Projects Senior NCO',
                'short_name' => 'Projects SNCO',
                'job_category_id' => 15,
            ],
            [
                'name' => 'Project Manager',
                'short_name' => 'Project Manager',
                'job_category_id' => 15,
            ],
            [
                'name' => 'Project Planner',
                'short_name' => 'Project Planner',
                'job_category_id' => 15,
            ],
            [
                'name' => 'Draughtsman',
                'short_name' => 'Draughtsman',
                'job_category_id' => 15,
            ],
            [
                'name' => 'Project Evaluator and Auditor',
                'short_name' => 'Project Evaluator and Auditor',
                'job_category_id' => 15,
            ],
            [
                'name' => 'Project Site Investigator',
                'short_name' => 'Project Site Investigator',
                'job_category_id' => 15,
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
