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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->text('address_line_1')->nullable();
            $table->text('address_line_2')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->string('type');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('number');
            $table->foreignId('bank_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->integer('opening_balance_in_cents');
            $table->dateTime('active_at')->nullable();
            $table->integer('minimum_signatories')->default(1);
            $table->integer('maximum_signatories')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['number', 'bank_id', 'type'], 'bank_account_number');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
