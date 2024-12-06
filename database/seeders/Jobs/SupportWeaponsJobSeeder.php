<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class SupportWeaponsJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'name' => 'Mortarman',
                'short_name' => null,
                'job_category_id' => 19,
            ],
            [
                'name' => 'Section Gunner Sergeant',
                'short_name' => null,
                'job_category_id' => 19,
            ],
            [
                'name' => 'Section Mortar Sergeant',
                'short_name' => null,
                'job_category_id' => 19,
            ],
            [
                'name' => 'Support Weapons Detachment Warrant Officer',
                'short_name' => null,
                'job_category_id' => 19,
            ],
            [
                'name' => 'Ammo Carrier',
                'short_name' => null,
                'job_category_id' => 19,
            ],
            [
                'name' => 'Anti Armour Gunner',
                'short_name' => null,
                'job_category_id' => 19,
            ],

            [
                'name' => 'Assistant Mortar Fire Controller',
                'short_name' => null,
                'job_category_id' => 19,
            ],
            [
                'name' => 'Control Post Operator',
                'short_name' => null,
                'job_category_id' => 19,
            ],
            [
                'name' => 'Gunner',
                'short_name' => null,
                'job_category_id' => 19,
            ],
            [
                'name' => 'Machine Gun Controller',
                'short_name' => null,
                'job_category_id' => 19,
            ],
            [
                'name' => 'Mortar Fire Controller',
                'short_name' => null,
                'job_category_id' => 19,
            ],
            [
                'name' => 'Weapon Sec Leader',
                'short_name' => null,
                'job_category_id' => 19,
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
