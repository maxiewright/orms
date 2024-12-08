<?php

namespace Database\Seeders\Contact;

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DivisionTypeSeeder::class,
            DivisionSeeder::class,
            CitySeeder::class,
        ]);
    }
}
