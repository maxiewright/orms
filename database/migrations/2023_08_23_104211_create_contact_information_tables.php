<?php

use App\Enums\Serviceperson\EmailTypeEnum;
use App\Enums\Serviceperson\PhoneTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('division_types')) {
            Schema::create('division_types', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (! Schema::hasTable('divisions')) {
            Schema::create('divisions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('division_type_id')->constrained();
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (! Schema::hasTable('cities')) {
            Schema::create('cities', function (Blueprint $table) {
                $table->id();
                $table->foreignId('division_id')->constrained();
                $table->string('name');
                $table->string('slug');
                $table->timestamps();
                $table->softDeletes();
                $table->unique(['name', 'division_id']);
            });

        }

        if (! Schema::hasTable('phone_numbers')) {
            Schema::create('phone_numbers', function (Blueprint $table) {
                $table->id();
                $table->integer('phoneable_id');
                $table->string('phoneable_type');
                $table->string('phone_number')->unique();
                $table->integer('type')->default(PhoneTypeEnum::Mobile->value);
                $table->unique(['phoneable_id', 'phoneable_type', 'type'], 'unique_phoneable_type');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (! Schema::hasTable('emails')) {
            Schema::create('emails', function (Blueprint $table) {
                $table->id();
                $table->integer('emailable_id');
                $table->string('emailable_type');
                $table->string('email')->unique();
                $table->integer('type')->default(EmailTypeEnum::Personal->value);
                $table->unique(['emailable_id', 'emailable_type', 'type'], 'unique_emailable_type');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
};
