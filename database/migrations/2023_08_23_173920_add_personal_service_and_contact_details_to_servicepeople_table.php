<?php

use App\Enums\ServiceData\EmploymentStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {

        Schema::table('servicepeople', function (Blueprint $table) {
            $table->string('image')->first()->nullable();

            // Personal Information
            $table->string('middle_name')->after('first_name')->nullable();
            $table->string('other_names')->after('last_name')->nullable();
            $table->after('date_of_birth', function (Blueprint $table) {
                $table->foreignId('marital_status_id')->nullable()->constrained();
                $table->foreignId('religion_id')->nullable()->constrained();
                $table->foreignId('ethnicity_id')->nullable()->constrained();
            });

            // Service Data
            $table->after('ethnicity_id', function (Blueprint $table){
                $table->foreignId('employment_status_id')->nullable()->constrained();
                $table->foreignId('battalion_id')->nullable()->constrained();
                $table->foreignId('company_id')->nullable()->constrained();
                $table->foreignId('department_id')->nullable()->constrained();
                $table->foreignId('job_id')->nullable()->constrained();
            });

            // Contact Information
            $table->after('assumption_date', function (Blueprint $table){
                $table->string('address_line_1')->nullable();
                $table->string('address_line_2')->nullable();
                $table->foreignId('city_id')->nullable()->constrained();
            });
            
        });
    }
};
