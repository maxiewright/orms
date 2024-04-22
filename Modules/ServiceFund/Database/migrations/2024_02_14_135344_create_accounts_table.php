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
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bank_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_id')->constrained();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->foreignId('city_id');
            $table->boolean('is_head_office')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['bank_id', 'address_line_1', 'city_id'], 'branch_address');
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->string('type');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('number');
            $table->foreignId('bank_branch_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->integer('opening_balance_in_cents');
            $table->dateTime('active_at')->nullable();
            $table->integer('minimum_signatories')->default(1);
            $table->integer('maximum_signatories')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['number', 'bank_branch_id', 'type'], 'bank_account_number');
        });

        Schema::create('reconciliations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained();
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->integer('closing_balance_in_cents');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['account_id', 'started_at', 'ended_at'], 'account_reconciliation_period');
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
