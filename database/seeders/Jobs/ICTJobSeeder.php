<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class ICTJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $jobs = [
            //            Information Technology
            [
                'name' => 'General Staff 6 - Communication and Signals',
                'short_name' => 'G6',
                'job_category_id' => 5,
            ],
            [
                'name' => 'Support Staff 6 - Communication and Signals',
                'short_name' => 'S6',
                'job_category_id' => 5,
            ],
            [
                'name' => 'General Staff 6 - SO3 Communication and Signals',
                'short_name' => 'SO3 ICT',
                'job_category_id' => 5,
            ],
            [
                'name' => 'Application Development Administrator',
                'short_name' => 'App Dev Admin',
                'job_category_id' => 5,
            ],
            [
                'name' => 'Application Development Technician',
                'short_name' => 'App Dev',
                'job_category_id' => 5,
            ],
            [
                'name' => 'Cyber Security Administrator',
                'short_name' => 'Cyber Security Admin',
                'job_category_id' => 5,
            ],
            [
                'name' => 'Cyber Security Technician',
                'short_name' => 'Cyber Security Tech',
                'job_category_id' => 5,
            ],
            [
                'name' => 'ICT Manager',
                'short_name' => 'ICT Manager',
                'job_category_id' => 5,
            ],
            [
                'name' => 'ICT Technician',
                'short_name' => 'ICT Tech',
                'job_category_id' => 5,
            ],
            [
                'name' => 'Jnr Administrator',
                'short_name' => 'Jnr Admin',
                'job_category_id' => 5,
            ],
            [
                'name' => 'Network & Cyber Security Administrator',
                'short_name' => 'Network Security Admin',
                'job_category_id' => 5,
            ],
            [
                'name' => 'Network Administrator',
                'short_name' => 'Network Admin',
                'job_category_id' => 5,
            ],
            [
                'name' => 'Regimental IT Warrant Officer',
                'short_name' => 'ICT WO',
                'job_category_id' => 5,
            ],
            [
                'name' => 'System Administrator',
                'short_name' => 'System Admin',
                'job_category_id' => 5,
            ],
            //          Communication - Signals
            [
                'name' => 'Regimental Signals Officer',
                'short_name' => 'RSO',
                'job_category_id' => 5,
            ],
            [
                'name' => 'Regimental Signals Warrant Officer',
                'short_name' => 'Signals WO',
                'job_category_id' => 5,
            ],
            [
                'name' => 'Signals Quarter Master Sergeant',
                'short_name' => 'Signals CQ',
                'job_category_id' => 5,
            ],
            [
                'name' => 'Signals Senior NCO',
                'short_name' => 'Signals SNCO',
                'job_category_id' => 5,
            ],
            [
                'name' => 'Radio Technician',
                'short_name' => 'Radio Tech',
                'job_category_id' => 5,
            ],
            [
                'name' => 'Signaller',
                'short_name' => 'Signaller',
                'job_category_id' => 5,
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
