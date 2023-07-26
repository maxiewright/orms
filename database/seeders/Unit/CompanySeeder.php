<?php

namespace Database\Seeders\Unit;

use App\Models\Unit\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $companies = [
            //1Engr
            [
                'name' => 'Support Squadron',
                'short_name' => 'Support Sqn',
                'battalion_id' => 1,
            ],
            // 2
            [
                'name' => 'Field and Construction Squadron',
                'short_name' => 'Fld & Const Sqn',
                'battalion_id' => 1,
            ],
            // 3
            [
                'name' => 'Electrical & Mechanical Engineering Squadron',
                'short_name' => 'EME Sqn',
                'battalion_id' => 1,
            ],

            //1TTR

            [
                'name' => 'Trinidad and Tobago Regiment Headquarters',
                'short_name' => 'RHQ',
                'battalion_id' => 2,
            ],
            [
                'name' => 'Special Forces Operations Detachment',
                'short_name' => 'SFOD',
                'battalion_id' => 3,
            ],
            [
                'name' => 'Headquarter Company First Infantry Battalion',
                'short_name' => 'HQ 1TTR',
                'battalion_id' => 2,
            ],
            [
                'name' => 'Alpha Company',
                'short_name' => 'A Coy',
                'battalion_id' => 2,
            ],
            [
                'name' => 'Bravo Company',
                'short_name' => 'B Coy',
                'battalion_id' => 2,
            ],
            [
                'name' => 'Charlie Company',
                'short_name' => 'C Coy',
                'battalion_id' => 2,
            ],

            //2TTR
            [
                'name' => 'Headquarter Company Second Infantry Battalion',
                'short_name' => 'HQ 2TTR',
                'battalion_id' => 3,
            ],
            [
                'name' => 'Echo Company',
                'short_name' => 'E Coy',
                'battalion_id' => 3,
            ],
            [
                'name' => 'Foxtrot Company',
                'short_name' => 'F Coy',
                'battalion_id' => 3,
            ],
            [
                'name' => 'Gulf Company',
                'short_name' => 'G Coy',
                'battalion_id' => 3,
            ],
            [
                'name' => 'Support Weapons Detachment',
                'short_name' => 'Spt Wpns',
                'battalion_id' => 3,
            ],

            //SSB
            [
                'name' => 'Headquarter Company Support and Service Battalion',
                'short_name' => 'HQ SSB',
                'battalion_id' => 4,
            ],
            [
                'name' => 'Supply and Transport Company',
                'short_name' => 'S & T SSB',
                'battalion_id' => 4,
            ],
            [
                'name' => 'Maintenance Company',
                'short_name' => 'Mn SSB',
                'battalion_id' => 4,
            ],

            // DFHQ
            [
                'name' => 'Specialised Youth Service Programme',
                'short_name' => 'SYSP',
                'battalion_id' => 5,
            ],
            [
                'name' => 'Defence Force Military Academy',
                'short_name' => 'DFHQ',
                'battalion_id' => 5,
            ],
        ];

        foreach ($companies as $company) {
            Company::query()->create([
                'name' => $company['name'],
                'short_name' => $company['short_name'],
                'battalion_id' => $company['battalion_id'],
            ]);
        }
    }
}
