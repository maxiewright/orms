<?php

use App\Enums\Serviceperson\EmergencyContactTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('relationships')) {
            Schema::create('relationships', function (Blueprint $table) {
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

        Schema::create('emergency_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serviceperson_number')
                ->constrained('servicepeople', 'number')
                ->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('relationship_id');
            $table->integer('type')
                ->default(EmergencyContactTypeEnum::Primary->value);
            $table->unique(['serviceperson_number', 'type'], 'serviceperson_emergency_contact_type');
            $table->timestamps();
        });

    }
};
