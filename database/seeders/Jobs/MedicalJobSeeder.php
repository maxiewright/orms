<?php

namespace Database\Seeders\Jobs;

use App\Models\Metadata\ServiceData\Job;
use Illuminate\Database\Seeder;

class MedicalJobSeeder extends Seeder
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
                'name' => 'Lab Technician',
                'short_name' => null,
                'job_category_id' => 10,
            ],
            [
                'name' => 'Medical Assistant',
                'short_name' => null,
                'job_category_id' => 10,
            ],
            [
                'name' => 'MIR Sergeant',
                'short_name' => null,
                'job_category_id' => 10,
            ],
            [
                'name' => 'Pharmaceuticals Manager',
                'short_name' => null,
                'job_category_id' => 10,
            ],
            [
                'name' => 'Phlebotomy SNCO',
                'short_name' => null,
                'job_category_id' => 10,
            ],
            [
                'name' => 'Regt WO IC MIR',
                'short_name' => null,
                'job_category_id' => 10,
            ],
            [
                'name' => 'RN Senior Medical NCO',
                'short_name' => null,
                'job_category_id' => 10,
            ],
            [
                'name' => 'SNCO IC Medical Stores',
                'short_name' => null,
                'job_category_id' => 10,
            ],
            [
                'name' => 'WO IC Medical Inspection Room SSB',
                'short_name' => null,
                'job_category_id' => 10,
            ],
            [
                'name' => 'Child Care Specialist',
                'short_name' => null,
                'job_category_id' => 10,
            ],
            [
                'name' => 'Medical Social Worker (to include Claims)',
                'short_name' => null,
                'job_category_id' => 10,
            ],
            [
                'name' => 'MWR Warrant Officer',
                'short_name' => null,
                'job_category_id' => 10,
            ],
            [
                'name' => 'Social Worker',
                'short_name' => null,
                'job_category_id' => 10,
            ],
            [
                'name' => 'Medic',
                'short_name' => null,
                'job_category_id' => 10,
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
