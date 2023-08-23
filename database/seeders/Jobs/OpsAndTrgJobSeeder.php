<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class OpsAndTrgJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            //            Operations
            [
                'name' => 'General Staff 3 - Operations',
                'short_name' => 'G3',
                'job_category_id' => 13,
            ],
            [
                'name' => 'Support Staff 3 - Operations',
                'short_name' => 'S3',
                'job_category_id' => 13,
            ],
            [
                'name' => 'Operations Warrant Officer',
                'short_name' => 'Ops WO',
                'job_category_id' => 13,
            ],
            [
                'name' => 'Operations SNCO',
                'short_name' => 'Operations SNCO',
                'job_category_id' => 13,
            ],

            //            Training
            [
                'name' => 'Plans & Training SNCO',
                'short_name' => null,
                'job_category_id' => 13,
            ],
            [
                'name' => 'Plans & Training Warrant Officer',
                'short_name' => null,
                'job_category_id' => 13,
            ],
            [
                'name' => 'Academy Training Warrant',
                'short_name' => 'Academy Trg WO',
                'job_category_id' => 13,
            ],

            [
                'name' => 'Regimental Drill Sergeant',
                'short_name' => 'Regimental Drill Sergeant',
                'job_category_id' => 13,
            ],
            [
                'name' => 'Training Warrant Officer',
                'short_name' => 'Trg WO',
                'job_category_id' => 13,
            ],
            [
                'name' => 'Weapons Training Warrant Officer',
                'short_name' => 'WTWO',
                'job_category_id' => 13,
            ],
            [
                'name' => 'Weapon Training Senior Instructor',
                'short_name' => 'WTSI',
                'job_category_id' => 13,
            ],
            [
                'name' => 'Senior Instructor',
                'short_name' => 'Snr Inst',
                'job_category_id' => 13,
            ],
            [
                'name' => 'Demonstrator',
                'short_name' => 'Demo Inst',
                'job_category_id' => 13,
            ],
            [
                'name' => 'Doctrine, Experimentation & Drills SNCO',
                'short_name' => null,
                'job_category_id' => 13,
            ],
            [
                'name' => 'Doctrine, Experimentation and Drills WO',
                'short_name' => null,
                'job_category_id' => 13,
            ],
            [
                'name' => 'G3 Operations Warrant Officer',
                'short_name' => null,
                'job_category_id' => 13,
            ],
            [
                'name' => 'Operations NCO',
                'short_name' => null,
                'job_category_id' => 13,
            ],
            [
                'name' => 'Research NCO',
                'short_name' => null,
                'job_category_id' => 13,
            ],
            [
                'name' => 'Training & Laison Sergeant',
                'short_name' => null,
                'job_category_id' => 13,
            ],
            [
                'name' => 'Physical Training Warrant Officer',
                'short_name' => 'PTWO',
                'job_category_id' => 13,
            ],
            [
                'name' => 'Physical Training Instructor',
                'short_name' => 'PTI',
                'job_category_id' => 13,
            ],
            [
                'name' => 'Training SNCO',
                'short_name' => null,
                'job_category_id' => 13,
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
