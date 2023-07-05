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
            $table->string('military_name')->virtualAs('concat(first_name, \' \', last_name)');
            $table->dateTime('date_of_birth');
            $table->foreignId('enlistment_type_id')->constrained();
            $table->dateTime('enlistment_date');
            $table->dateTime('assumption_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
