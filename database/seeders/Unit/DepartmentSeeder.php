<?php

namespace Database\Seeders\Unit;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            'Headquarters' => 'HQ',
            'Orderly Room' => 'Orderly Room',
            'Human Resource' => 'HR',
            'Legal' => 'Legal',
            'Operations' => 'Ops',
            'Procurement' => 'Procurement',
            'Projects' => 'Projects',
            'Information and Communication Technology' => 'ICT',
            'Public Affairs' => 'PA',
            'Welfare' => 'Welfare',
            'Company Office' => 'Coy Office',
            'Signals Centre' => 'Sigs',
            'Officers Mess' => 'Offr Mess',
            'Warrant Officers & Senior NCO Mess' => 'WO & SNCO Mess',
            'Male Officers Quarters' => 'BOQ',
            'Female Officers Quarters' => 'FOQ',
            'Male Warrant Officers & Senior NCO Quarters' => 'Male WO & SNCO Quarters',
            'Female Warrant Officers & Senior NCO Quarters' => 'Female WO & SNCO Quarters',
            'Male Enlisted Quarters' => 'Male Barrack Room',
            'Female Enlisted Quarters' => 'Female Barrack Room',
            'Quartermaster Stores' => 'QM',
            'Company Stores' => 'Coy Stores',
            'Corporals Club' => 'Cpl Club',
            'Dining Facility' => 'DFAC',
            'Mechanical Transport' => 'MT',
            'Canteen' => 'Canteen',
            'Band Room' => 'Band Room',
            'Ration Stores' => 'Ration Stores',
            'Medical Inspection Room' => 'MIR',
            'Unit Guard Room' => 'Guard Room',
        ];

        foreach ($departments as $department => $slug) {
            Department::query()->create([
                'name' => $department,
                'slug' => $slug,
            ]);
        }
    }
}
