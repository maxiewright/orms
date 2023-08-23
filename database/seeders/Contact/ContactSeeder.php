<?php

namespace Database\Seeders\Contact;

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            DivisionTypeSeeder::class,
            DivisionSeeder::class,
            CitySeeder::class,
        ]);
    }
}
