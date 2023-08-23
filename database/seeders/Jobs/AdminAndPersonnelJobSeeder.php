<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class AdminAndPersonnelJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            //            G1 Shop
            [
                'name' => 'General Staff 1 - Personal',
                'short_name' => 'G1',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Support Staff 1 - Personal',
                'short_name' => 'S1',
                'job_category_id' => 1,
            ],

            //            Personnel
            [
                'name' => 'SO3 Personnel ',
                'short_name' => 'HRO',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Human Resource Warrant Officer',
                'short_name' => 'HR WO',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Human Resource Senior NCO',
                'short_name' => 'HR SNCO',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Human Resource Clerk',
                'short_name' => 'HR Clerk',
                'job_category_id' => 1,
            ],
            //            Legal
            [
                'name' => 'SO3 Legal',
                'short_name' => 'G1-Legal',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Legal Warrant Officer',
                'short_name' => 'Legal WO',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Legal Senior NCO',
                'short_name' => 'Legal SNCO',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Legal Clerk',
                'short_name' => 'Legal Clerk',
                'job_category_id' => 1,
            ],
            //            Administration
            [
                'name' => 'Chief Clerk',
                'short_name' => 'Chief Clerk',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Administrative Senior Non Commissioned Officer ',
                'short_name' => 'Admin NCO',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Clerk in-charge of dispatch',
                'short_name' => 'IC Dispatch',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Clerk in-charge of Registry',
                'short_name' => 'IC Registry',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Administrative Clerk',
                'short_name' => 'Admin Clerk',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Clerk',
                'short_name' => 'Clerk',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Typist',
                'short_name' => 'Typist',
                'job_category_id' => 1,
            ],
            //            Education
            [
                'name' => 'Education Warrant Officer',
                'short_name' => 'Education WO',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Education Senior NCO',
                'short_name' => 'Education SNCO',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Education Records NCO',
                'short_name' => 'Education Records NCO',
                'job_category_id' => 1,
            ],
            [
                'name' => 'Research and Development Senior SNCO',
                'short_name' => 'R&D SNCO',
                'job_category_id' => 1,
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
