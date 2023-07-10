<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $admins = [
            [198, '198wrightm', 'maxie.wright@ttdf.mil.tt'],
            [249, '249derryp', 'petal.derry@ttdf.mil.tt'],
            [250, '250davida', 'addison.david@ttdf.mil.tt'],
        ];

        foreach ($admins as $admin){
            User::query()->create([
                'serviceperson_number' => $admin[0],
                'name' => $admin[1],
                'email' => $admin[2],
                'email_verified_at' => now(),
                'password' => Hash::make('Password1')
            ]);
        }

    }
}
