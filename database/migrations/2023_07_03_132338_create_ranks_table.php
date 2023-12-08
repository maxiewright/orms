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
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('regiment')->unique();
            $table->string('regiment_abbreviation')->unique();
            $table->string('coast_guard')->unique();
            $table->string('coast_guard_abbreviation')->unique();
            $table->json('air_guard')->unique();
            $table->json('air_guard_abbreviation')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranks');
    }
};
