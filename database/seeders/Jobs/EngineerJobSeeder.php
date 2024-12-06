<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class EngineerJobSeeder extends Seeder
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
                'name' => 'Air-condition and Refrigeration Technician',
                'short_name' => 'AC Tech',
                'job_category_id' => 4,
            ],
            [
                'name' => 'Auto Body Technician',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Service Bay Operator',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Sign Painter',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Upholsterer',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Auto Electrician',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Vehicle Electrician',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Battery Technician',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Tyre Technician',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Carpenter',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Joiner',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Electrical Linesman',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Electrician',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Power Generation Troop Second in Command',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Power Generation Troop Staff Sergeant',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Support Troop Maintenance Sergeant',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Training Troop Training Sergeant',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Troop Sergeant',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Welder',
                'short_name' => 'Welder',
                'job_category_id' => 4,
            ],
            [
                'name' => 'eme',
                'short_name' => 'eme',
                'job_category_id' => 4,
            ],
            [
                'name' => 'Mechanic',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Vehicle Mechanic',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Workshop Sergeant',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Workshop Warrant Officer',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Backhoe Operator',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Bridging NCO',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Bridging Section SNCO',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Bulldozer Operator',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Dump Truck Operator',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Equipment Operator',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Equipment Staff Sergeant',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Front End Loader Operator',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Plant Operator',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Sapper / Ops Asst',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Support Troop Maintenance Staff Sergeant',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Support Troop Warrant Officer',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Troop Equipment Operator',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Athletic Trainer',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Plumber',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Pipefitter',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Water Purifier',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'POL Attendant',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Surveyor',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Machinist',
                'short_name' => null,
                'job_category_id' => 4,
            ],
            [
                'name' => 'Mason',
                'short_name' => null,
                'job_category_id' => 4,
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
