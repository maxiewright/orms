<?php

namespace Database\Seeders\Interview;

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

    public function run(): void
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
