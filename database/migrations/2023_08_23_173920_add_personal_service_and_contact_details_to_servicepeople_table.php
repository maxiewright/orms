<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {

        Schema::table('servicepeople', function (Blueprint $table) {
            // Personal Information
            $table->string('middle_name')->after('first_name')->nullable();
            $table->string('other_names')->after('last_name')->nullable();
            $table->after('date_of_birth', function (Blueprint $table) {
                $table->foreignId('marital_status_id')->nullable()->constrained();
                $table->foreignId('religion_id')->nullable()->constrained();
                $table->foreignId('ethnicity_id')->nullable()->constrained();
            });

            // Service Data
            $table->foreignId('employment_status_id')->nullable()->constrained();
            $table->foreignId('battalion_id')->nullable()->constrained();
            $table->foreignId('company_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('job_id')->constrained();

            // Contact Information
            $table->string('phone')->nullable()->unique();
            $table->string('alternate_phone')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('alternate_email')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->foreignId('city_id')->nullable()->constrained();

            //  Next of kin
            $table->string('next_of_kin')->nullable();
            $table->foreignId('next_of_kin_relationship_id')->nullable()->constrained('relationships');
            $table->string('next_of_kin_phone')->nullable();
            $table->string('next_of_kin_alternate_phone')->nullable();
        });
    }
};
