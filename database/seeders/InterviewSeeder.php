<?php

namespace Database\Seeders;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InterviewSeeder extends Seeder
{
    protected $toTruncate = ['users', 'interviews', 'serviceperson_interview', 'servicepeople'];

    public function run(): void
    {
        Model::unguard();

        Schema::disableForeignKeyConstraints();

        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        Schema::enableForeignKeyConstraints();

        $admins = [
            [198, 1, 12, 'Maxie', 'Wright', '1984-09-02', 2, '2009-03-05', '2009-03-05', 1],
            [249, 1, 12, 'Petal', 'Derry', '1981-09-18', 3, '2019-07-26', '2019-07-26', 2],
            [250, 1, 12, 'Addison', 'David', '1987-06-24', 3, '2019-07-26', '2019-07-26', 1],
        ];

        foreach ($admins as $admin) {
            Serviceperson::create([
                'number' => $admin[0],
                'formation_id' => $admin[1],
                'rank_id' => $admin[2],
                'first_name' => $admin[3],
                'last_name' => $admin[4],
                'date_of_birth' => $admin[5],
                'enlistment_type_id' => $admin[6],
                'enlistment_date' => $admin[7],
                'assumption_date' => $admin[8],
                'gender_id' => $admin[9],
            ]);
        }

        $this->call([
            AdminSeeder::class,
            ServicepeopleWithInterviewsSeeder::class,
        ]);

        Model::reguard();

    }

    //
    //
    //

}
