<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interview_reasons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('particulars')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('interview_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('particulars')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->constrained();
            $table->foreignId('requested_by')
                ->constrained('servicepeople', 'number');
            $table->dateTime('requested_at');
            $table->foreignId('interview_status_id')
                ->default(1)->constrained();
            $table->foreignId('interview_reason_id')
                ->constrained();
            $table->string('subject');
            $table->text('particulars')->nullable();
            $table->dateTime('seen_at')->nullable();
            $table->foreignId('seen_by')
                ->nullable()
                ->constrained('servicepeople', 'number');
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('interviews')
                ->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('serviceperson_interview', function (Blueprint $table) {
            $table->foreignId('serviceperson_number')
                ->constrained('servicepeople', 'number');
            $table->foreignId('interview_id')->constrained();
            $table->dateTime('read_at')->nullable();
            $table->boolean('agreed')->nullable();
        });

    }
};
