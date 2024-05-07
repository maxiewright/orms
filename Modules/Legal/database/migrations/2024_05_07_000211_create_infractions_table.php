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
        Schema::create('infractions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(config('legal.accused'))->constrained('servicepeople');
            $table->dateTime('occurred_at');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->foreignId('country_id')->nullable()->constrained();
            $table->foreignIdFor(config('legal.state'))->constrained();
            $table->foreignIdFor(config('legal.city'))->constrained();
            $table->string('status');
            $table->text('particulars');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infractions');
    }
};
