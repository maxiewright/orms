<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servicepeople', function (Blueprint $table) {
            $table->id('number');
            $table->foreignId('formation_id')->constrained();
            $table->foreignId('rank_id')->constrained();
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('gender_id')->nullable()->constrained();
            $table->dateTime('date_of_birth')->nullable();
            $table->foreignId('enlistment_type_id')->constrained();
            $table->dateTime('enlistment_date')->nullable();
            $table->dateTime('assumption_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('serviceperson_number')
                ->after('id')
                ->constrained('servicepeople', 'number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serviceperson');
    }
};
