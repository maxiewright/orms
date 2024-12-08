<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendee_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->tinyText('particulars')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('attendees', function (Blueprint $table) {
            $table->id();
            $table->integer('attendable_id');
            $table->string('attendable_type');
            $table->foreignId('serviceperson_number')
                ->constrained('servicepeople', 'number');
            $table->foreignId('attendee_role_id')->constrained();
            $table->dateTime('read_at')->nullable();
            $table->boolean('agreed')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
