<?php

namespace Database\Seeders;

use Database\Seeders\Interview\AttendeeRoleSeeder;
use Database\Seeders\Interview\InterviewReasonSeeder;
use Database\Seeders\Interview\InterviewStatusSeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InterviewSeeder extends Seeder
{
    protected $toTruncate = [
        'attendee_roles',
        'interview_reasons',
        'interview_statuses',
    ];

    public function run()
    {
        Model::unguard();

        Schema::disableForeignKeyConstraints();

        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        Schema::enableForeignKeyConstraints();

        $this->call([
            AttendeeRoleSeeder::class,
            InterviewReasonSeeder::class,
            InterviewStatusSeeder::class,
        ]);
    }
}
