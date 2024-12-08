<?php

namespace Database\Seeders\Unit;

use App\Models\Unit\Battalion;
use Illuminate\Database\Seeder;

class BattalionSeeder extends Seeder
{
    public function run(): void
    {
        $battalions = [
            [
                'name' => '1st Engineer Battalion',
                'short_name' => '1Engr',
            ],
            [
                'name' => '1st Infantry Battalion',
                'short_name' => '1TTR',
            ],
            [
                'name' => '2nd Infantry Battalion',
                'short_name' => '2TTR',
            ],
            [
                'name' => 'Support and Service Battalion',
                'short_name' => 'SSB',
            ],
            [
                'name' => 'Defence Force Headquarters',
                'short_name' => 'DFHQ',
            ],
        ];

        foreach ($battalions as $battalion) {
            Battalion::query()->create([
                'name' => $battalion['name'],
                'short_name' => $battalion['short_name'],
            ]);
        }

    }
}
