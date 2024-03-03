<?php

namespace Modules\ServiceFund\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\ServiceFund\App\Models\Contact;
use Modules\ServiceFund\App\Models\TransactionCategory;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::factory()->count(10)->create();
    }
}
