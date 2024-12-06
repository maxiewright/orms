<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class PRJobSeeder extends Seeder
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
                'name' => 'General Staff 7 - Public Affairs',
                'short_name' => 'G7',
                'job_category_id' => 14,
            ],
            [
                'name' => 'Support Staff 7 - Public Affairs',
                'short_name' => 'S7',
                'job_category_id' => 14,
            ],
            [
                'name' => 'Public Relations Warrant Officer',
                'short_name' => null,
                'job_category_id' => 14,
            ],
            [
                'name' => 'Audio Visual Technician',
                'short_name' => null,
                'job_category_id' => 14,
            ],
            [
                'name' => 'Creative Media Production',
                'short_name' => null,
                'job_category_id' => 14,
            ],
            [
                'name' => 'Editor Print, Audio & Electric Media & Regiment Archives ',
                'short_name' => null,
                'job_category_id' => 14,
            ],
            [
                'name' => 'Journalist',
                'short_name' => null,
                'job_category_id' => 14,
            ],
            [
                'name' => 'Protocol Specialist',
                'short_name' => null,
                'job_category_id' => 14,
            ],
            [
                'name' => 'Snr Journalist',
                'short_name' => null,
                'job_category_id' => 14,
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
