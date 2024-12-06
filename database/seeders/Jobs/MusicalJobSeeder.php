<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class MusicalJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'name' => 'Bugle Corporal',
                'short_name' => null,
                'job_category_id' => 12,
            ],
            [
                'name' => 'Bugle Sergeant',
                'short_name' => null,
                'job_category_id' => 12,
            ],
            [
                'name' => 'Drum Corporal',
                'short_name' => null,
                'job_category_id' => 12,
            ],
            [
                'name' => 'Drum Major',
                'short_name' => null,
                'job_category_id' => 12,
            ],
            [
                'name' => 'Drum Sergeant',
                'short_name' => null,
                'job_category_id' => 12,
            ],
            [
                'name' => 'Drummer',
                'short_name' => null,
                'job_category_id' => 12,
            ],
            [
                'name' => 'Band Admin SNCO',
                'short_name' => null,
                'job_category_id' => 12,
            ],
            [
                'name' => 'Band Librarian',
                'short_name' => null,
                'job_category_id' => 12,
            ],
            [
                'name' => 'Bandmaster',
                'short_name' => null,
                'job_category_id' => 12,
            ],
            [
                'name' => 'Bandsman',
                'short_name' => null,
                'job_category_id' => 12,
            ],
            [
                'name' => 'Dance Band Warrant Officer',
                'short_name' => null,
                'job_category_id' => 12,
            ],
            [
                'name' => 'Musical Arranger',
                'short_name' => null,
                'job_category_id' => 12,
            ],
            [
                'name' => 'SNCO IC Instruments',
                'short_name' => null,
                'job_category_id' => 12,
            ],
            [
                'name' => 'Electronics  SNCO',
                'short_name' => null,
                'job_category_id' => 12,
            ],
            [
                'name' => 'Instrument Repairman',
                'short_name' => null,
                'job_category_id' => 12,
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
