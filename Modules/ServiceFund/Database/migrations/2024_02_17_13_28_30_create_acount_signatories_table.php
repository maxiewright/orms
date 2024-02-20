<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_signatories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('signatory_id');
            $table->dateTime('active_from')->nullable();
            $table->dateTime('inactive_from')->nullable();
            $table->text('particulars')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
