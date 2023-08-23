<?php

namespace Database\Seeders;

use App\Models\Metadata\ServiceData\JobCategory;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
    public function run()
    {
        $jobCategories = [
            [
                'name' => 'Administration and Personnel',
                'short_name' => 'Admin & Personnel',
            ],
            [
                'name' => 'Advisory',
                'short_name' => 'Advisory',
            ],
            [
                'name' => 'Command',
                'short_name' => 'Command',
            ],
            [
                'name' => 'Engineers',
                'short_name' => 'Engr',
            ],
            [
                'name' => 'Information Communication Technology',
                'short_name' => 'ICT',
            ],
            [
                'name' => 'Infantry',
                'short_name' => 'Inf',
            ],
            [
                'name' => 'Intelligence',
                'short_name' => 'Intel',
            ],
            [
                'name' => 'Logistics and Finance',
                'short_name' => 'Logs & Finance',
            ],
            [
                'name' => 'Maintenance',
                'short_name' => 'Maintenance',
            ],
            [
                'name' => 'Medical',
                'short_name' => 'Medical',
            ],
            [
                'name' => 'Messing',
                'short_name' => 'Messing',
            ],
            [
                'name' => 'Musical',
                'short_name' => 'Musical',
            ],
            [
                'name' => 'Operations and Training',
                'short_name' => 'Ops & Trg',
            ],
            [
                'name' => 'Public Relations',
                'short_name' => 'PR',
            ],
            [
                'name' => 'Plans and Project',
                'short_name' => 'Projects',
            ],
            [
                'name' => 'Quartermaster',
                'short_name' => 'QM',
            ],
            [
                'name' => 'Special Forces',
                'short_name' => 'SF',
            ],
            [
                'name' => 'Supply Services',
                'short_name' => 'Supply Services',
            ],
            [
                'name' => 'Support Weapons',
                'short_name' => 'Support Weapons',
            ],
            [
                'name' => 'Transport',
                'short_name' => 'Transport',
            ],
        ];

        foreach ($jobCategories as $category) {
            JobCategory::query()->create([
                'name' => $category['name'],
                'short_name' => $category['short_name'],
            ]);
        }

    }
}
