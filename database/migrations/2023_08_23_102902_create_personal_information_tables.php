<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('next_of_kin_relationships')) {
            Schema::create('next_of_kin_relationships', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->tinyText('description')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (! Schema::hasTable('religions')) {
            Schema::create('religions', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->tinyText('description')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (! Schema::hasTable('marital_statuses')) {
            Schema::create('marital_statuses', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->tinyText('description')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (! Schema::hasTable('ethnicities')) {
            Schema::create('ethnicities', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->tinyText('description')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (! Schema::hasTable('emails')){
            Schema::create('emails', function (Blueprint $table) {
                $table->id();
                $table->integer('emailable_id');
                $table->string('emailable_type');
                $table->string('email')->unique();
                $table->integer('type')->default(EmailTypeEnum::Personal);
                $table->unique(['emailable_id', 'emailable_type', 'type'], 'unique_emailable_type');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (! Schema::hasTable('phone_numbers')){
            Schema::create('phone_numbers', function (Blueprint $table) {
                $table->id();
                $table->integer('phoneable_id');
                $table->string('phoneable_type');
                $table->string('phone_number')->unique();
                $table->integer('type')->default(PhoneTypeEnum::Mobile);
                $table->unique(['phoneable_id', 'phoneable_type', 'type'], 'unique_phoneable_type');
                $table->timestamps();
                $table->softDeletes();
            });
        }


    }
};
