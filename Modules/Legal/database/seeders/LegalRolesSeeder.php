<?php

namespace Modules\Legal\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class LegalRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'legal_clerk',
            'legal_admin_clerk',
            'legal_senior_enlisted_advisor',
            'legal_officer',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

    }
}
