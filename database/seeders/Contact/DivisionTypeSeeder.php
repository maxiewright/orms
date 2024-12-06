<?php

namespace Database\Seeders\Contact;

use App\Models\Metadata\Contact\DivisionType;
use Illuminate\Database\Seeder;

class DivisionTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['Region', 'Borough', 'City', 'Ward'];

        foreach ($types as $type) {
            DivisionType::query()->create([
                'name' => $type,
            ]);
        }
    }
}
