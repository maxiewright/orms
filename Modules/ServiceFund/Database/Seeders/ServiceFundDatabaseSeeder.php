<?php

namespace Modules\ServiceFund\Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceFundDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            TransactionCategorySeeder::class,
        ]);
    }
}
