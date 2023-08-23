<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('employment_statuses')) {
            Schema::create('employment_statuses', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('short_name')->unique();
                $table->string('slug')->unique();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (! Schema::hasTable('departments')) {
            Schema::create('departments', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (! Schema::hasTable('company_department')) {
            Schema::create('company_department', function (Blueprint $table) {
                $table->foreignId('company_id')->constrained();
                $table->foreignId('department_id')->constrained();
            });
        }

        if (! Schema::hasTable('job_categories')) {
            Schema::create('job_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('short_name')->unique();
                $table->string('slug')->unique();
                $table->text('particulars')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (! Schema::hasTable('jobs')) {
            Schema::create('jobs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('job_category_id')->constrained();
                $table->string('name');
                $table->string('short_name');
                $table->string('slug');
                $table->unique('job_category_id', 'name');
                $table->timestamps();
                $table->softDeletes();
            });
        }

    }
};
