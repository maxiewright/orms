<?php

namespace Database\Seeders;

use Database\Seeders\Unit\BattalionSeeder;
use Database\Seeders\Unit\CompanySeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UnitSeeder extends Seeder
{
    protected $toTruncate = ['battalions', 'companies'];

    public function run()
    {
        Model::unguard();

        Schema::disableForeignKeyConstraints();

        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        Schema::enableForeignKeyConstraints();

        $this->call([
            BattalionSeeder::class,
            CompanySeeder::class,
        ]);
    }
}
