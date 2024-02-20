<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('contacts')) {
            Schema::create('contacts', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('phone');
                $table->string('email')->unique()->nullable();
                $table->string('website')->nullable();
                $table->string('address_line_1')->nullable();
                $table->string('address_line_2')->nullable();
                $table->foreignId('city_id')->nullable();
                $table->text('particulars')->nullable();
                $table->foreignId('added_by')->constrained('users');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
};
