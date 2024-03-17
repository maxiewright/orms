<?php

namespace Modules\ServiceFund\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\ServiceFund\App\Models\TransactionCategory;

class TransactionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $categories = [
            'deposit',
            'reimbursement',
            'advance',
        ];

        foreach ($categories as $category) {
            TransactionCategory::query()->create([
                'name' => $category,
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
