<?php

namespace Modules\Legal\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Legal\Database\Seeders\Offences\SummaryOffenceDivisionSeeder;
use Modules\Legal\Database\Seeders\Offences\SummaryOffenceSectionSeeder;

class OffenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $this->call([
                SummaryOffenceDivisionSeeder::class,
                SummaryOffenceSectionSeeder::class,
            ]);
        });
    }
}
