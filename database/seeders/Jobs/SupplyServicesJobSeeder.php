<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class SupplyServicesJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'name' => 'Armourer',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Bn Arms NCO',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Cobbler',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Floor Manager Tailor Shop',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Master Tailor',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Ordinance Tehnician',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Ordinance SNCO',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Cobbler Shop SNCO',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Ammo Tech SNCO',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'SNCO IC Tailors & Cobblers',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Tailor Shop SNCO',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Snr Cutter Tailor Shop',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Tailors',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Regimental Armourer',
                'short_name' => null,
                'job_category_id' => 18,
            ],

            [
                'name' => 'Bn PRI',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Canteen Orderly',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Coordinating / Auditing SNCO',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'Corporals Club Orderly',
                'short_name' => null,
                'job_category_id' => 18,
            ],

            [
                'name' => 'NCO IC Corporals Club',
                'short_name' => null,
                'job_category_id' => 18,
            ],
            [
                'name' => 'PRI Canteen Orderly',
                'short_name' => null,
                'job_category_id' => 18,
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
