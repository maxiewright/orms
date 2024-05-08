<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Legal\Models\Infraction;
use Modules\Legal\Models\PoliceStation;
use Modules\Legal\Models\SummaryOffence;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('summary_offences', function (Blueprint $table) {
            $table->id();
            $table->string('section_number');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('police_stations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->foreignId('country_id')->nullable()->constrained();
            $table->foreignId(config('legal.state'))->constrained();
            $table->foreignId(config('legal.city'))->constrained();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('infractions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accused_id')
                ->constrained(config('legal.accused.database_table'), config('legal.accused.id'));
            $table->dateTime('occurred_at');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->foreignId('country_id')->nullable()->constrained();
            $table->foreignIdFor(config('legal.state'))->constrained();
            $table->foreignIdFor(config('legal.city'))->constrained();
            $table->string('status');
            $table->text('particulars');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Infraction::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SummaryOffence::class)->constrained();
            $table->dateTime('charged_at');
            $table->foreignIdFor(PoliceStation::class)->constrained();
            $table->string('charged_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charges');
        Schema::dropIfExists('infractions');
    }
};
