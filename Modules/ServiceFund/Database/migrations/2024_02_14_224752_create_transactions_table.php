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
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id');
            $table->string('type');
            $table->dateTime('executed_at');
            $table->decimal('amount', 13);
            $table->string('payment_method');
            $table->integer('cheque_number')->nullable();
            $table->foreignId('transaction_category_id')->constrained();
            $table->text('description')->nullable();
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('transactions')
                ->cascadeOnDelete();
            $table->morphs('transactional');
            $table->foreignId('approved_by');
            $table->dateTime('approved_at');
            $table->foreignId('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
