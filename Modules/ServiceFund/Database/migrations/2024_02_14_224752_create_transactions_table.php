<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('transaction_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('transaction_categories')
                ->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id');
            $table->string('type');
            $table->dateTime('executed_at');
            $table->decimal('amount_in_cents', 13);
            $table->string('payment_method');
            $table->integer('cheque_number')->nullable();
            $table->text('particulars')->nullable();
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('transactions')
                ->cascadeOnDelete();
            $table->morphs('transactional');
            $table->foreignId('approved_by')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('created_by');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('transaction_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions');
            $table->foreignId('transaction_category_id')->constrained('transaction_categories');
            $table->timestamps();
        });

        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credit_transaction_id')->constrained('transactions');
            $table->foreignId('debit_transaction_id')->constrained('transactions');
            $table->dateTime('transferred_at');
            $table->timestamps();
            $table->softDeletes();
        });

    }
};
