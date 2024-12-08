<?php

namespace Database\Seeders\ServiceData;

use App\Models\Metadata\ServiceData\EmploymentStatus;
use Illuminate\Database\Seeder;

class EmploymentStatusSeeder extends Seeder
{
    public function run(): void
    {
        $employmentStatuses = [
            [
                'name' => 'Available for duty',
                'short_name' => 'Available',
            ],
            [
                'name' => 'Privilege leave',
                'short_name' => 'P/L',
            ],
            [
                'name' => 'Sick leave',
                'short_name' => 'S/L',
            ],
            [
                'name' => 'Internal Training',
                'short_name' => 'Local Trg',
            ],
            [
                'name' => 'In-service Training',
                'short_name' => 'In-service',
            ],
            [
                'name' => 'Foreign Military Training',
                'short_name' => 'Overseas Trg',
            ],
            [
                'name' => 'Resettlement Training',
                'short_name' => 'R/Trg',
            ],
            [
                'name' => 'Absent Without Leave',
                'short_name' => 'AWOL',
            ],
            [
                'name' => 'Confined to Barracks',
                'short_name' => 'CB',
            ],
            [
                'name' => 'Detention',
                'short_name' => 'DB',
            ],

        ];

        foreach ($employmentStatuses as $status) {
            EmploymentStatus::query()->create([
                'name' => $status['name'],
                'short_name' => $status['short_name'],
            ]);
        }

    }
}
