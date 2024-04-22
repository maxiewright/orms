<?php

namespace Modules\ServiceFund\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\ServiceFund\App\Models\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Commercial banks in Trinidad and Tobago
        $banks = [
            'Bank of Baroda',
            'CIBC FirstCaribbean International Bank',
            'Citi',
            'First Citizens Bank',
            'JMMB Bank',
            'RBC Royal Bank',
            'Republic Bank',
            'Scotiabank',
        ];

        foreach ($banks as $bank) {
            Bank::query()->create([
                'name' => $bank,
            ]);
        }


    }
}
