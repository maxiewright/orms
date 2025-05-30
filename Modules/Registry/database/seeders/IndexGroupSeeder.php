<?php

namespace Modules\Registry\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Registry\Models\RegistryIndex\IndexGroup;

class IndexGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'id' => 1,
                'name' => 'Accommodation',
            ],
            [
                'id' => 2,
                'name' => 'Administration',
            ],
            [
                'id' => 3,
                'name' => 'Boards',
            ],
            [
                'id' => 4,
                'name' => 'Conference/Committee meetings',
            ],
            [
                'id' => 5,
                'name' => 'Funerals/War Graves',
            ],
            [
                'id' => 6,
                'name' => 'Government Officials',
            ],
            [
                'id' => 7,
                'name' => 'Financial and Accounting Matters',
            ],
            [
                'id' => 8,
                'name' => 'Operations',
            ],
            [
                'id' => 9,
                'name' => 'parades',
            ],
            [
                'id' => 10,
                'name' => 'Personnel',
            ],
            [
                'id' => 11,
                'name' => 'Establishment',
            ],
            [
                'id' => 12,
                'name' => 'Training',
            ],
            [
                'id' => 13,
                'name' => 'Sports',
            ],
            [
                'id' => 14,
                'name' => 'Security',
            ],
            [
                'id' => 15,
                'name' => 'Volunteer Defence Force',
            ],
            [
                'id' => 16,
                'name' => 'Medical & Dental',
            ],
        ];

        foreach ($groups as $group) {
            IndexGroup::query()->create($group);
        }
    }
}
