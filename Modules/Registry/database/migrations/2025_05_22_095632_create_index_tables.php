<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Registry\Models\RegistryIndex\IndexGroup;
use Modules\Registry\Models\RegistryIndex\IndexSubGroup;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('index_groups', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('index_sub_groups', function (Blueprint $table): void {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->foreignIdFor(IndexGroup::class)->constrained();
            $table->timestamps();
        });

        Schema::create('index_subjects', function (Blueprint $table): void {
            $table->id();
            $table->string('reference_number')->unique();
            $table->foreignIdFor(IndexSubGroup::class)->constrained();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('index_subjects');
        Schema::dropIfExists('index_sub_groups');
        Schema::dropIfExists('index_groups');
    }

};
