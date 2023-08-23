<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class InfantryJobSeeder extends Seeder
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
                'name' => 'Coy Runner',
                'short_name' => null,
                'job_category_id' => 6,
            ],
            [
                'name' => 'Machine Gunner(Gun Team)',
                'short_name' => null,
                'job_category_id' => 6,
            ],
            [
                'name' => 'Ammo Bearer(Gun Team)',
                'short_name' => null,
                'job_category_id' => 6,
            ],
            [
                'name' => 'Rifleman',
                'short_name' => null,
                'job_category_id' => 6,
            ],
            [
                'name' => 'Assistant Control Post Operator',
                'short_name' => null,
                'job_category_id' => 6,
            ],
            [
                'name' => 'Assistant Gunner',
                'short_name' => null,
                'job_category_id' => 6,
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
