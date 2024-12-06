<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class TransportJobSeeder extends Seeder
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
                'name' => 'Despatch Rider',
                'short_name' => null,
                'job_category_id' => 20,
            ],
            [
                'name' => 'Bn MT Sergeant',
                'short_name' => null,
                'job_category_id' => 20,
            ],
            [
                'name' => 'Escort',
                'short_name' => null,
                'job_category_id' => 20,
            ],
            [
                'name' => 'Driver',
                'short_name' => null,
                'job_category_id' => 20,
            ],
            [
                'name' => 'Dispatch Rider',
                'short_name' => null,
                'job_category_id' => 20,
            ],
            [
                'name' => 'Dispatch SNCO',
                'short_name' => null,
                'job_category_id' => 20,
            ],
            [
                'name' => 'Fleet Manager',
                'short_name' => null,
                'job_category_id' => 20,
            ],
            [
                'name' => 'Mechanical Transport Warrant Officer',
                'short_name' => null,
                'job_category_id' => 20,
            ],
            [
                'name' => 'Dispatch NCO',
                'short_name' => null,
                'job_category_id' => 20,
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
