<?php

namespace Database\Seeders;

use App\Models\Serviceperson;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminServicepersonSeeder extends Seeder
{
    public function run()
    {
        $serviceperson = Serviceperson::factory()->officer()->create();

        $firstName = $serviceperson->first_name;
        $lastName = $serviceperson->last_name;
        $username = $serviceperson->number.''.$lastName.''.Str::substr($firstName, 0, 1);

        User::create([
            'serviceperson_number' => $serviceperson->number,
            'name' => Str::lower($username),
            'email' => "$firstName.$lastName@ttdf.mil.tt",
            'email_verified_at' => now(),
            'password_changed_at' => now(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
