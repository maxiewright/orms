<?php

namespace Database\Seeders\Interview;

use App\Models\Metadata\AttendeeRole;
use Illuminate\Database\Seeder;

class AttendeeRoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'witness',
            'personnel officer',
            'commanding officer',
            'senior enlisted advisor',
        ];

        foreach ($roles as $role) {
            AttendeeRole::query()->create([
                'name' => $role,
            ]);
        }
    }
}
