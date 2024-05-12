<?php

use App\Models\Metadata\Contact\City;
use App\Models\Metadata\Contact\Division;
use App\Models\Serviceperson;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Legal\Models\Ancillary\Infraction\PoliceStation;
use Modules\Legal\Models\Ancillary\Infraction\SummaryOffenceDivision;
use Modules\Legal\Models\Ancillary\Infraction\SummaryOffenceSection;
use Modules\Legal\Models\Ancillary\JusticeInstitution;
use Modules\Legal\Models\Infraction;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('summary_offence_divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('particulars')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('summary_offence_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SummaryOffenceDivision::class)->constrained();
            $table->string('section_number')->unique();
            $table->string('name')->unique();
            $table->text('particulars')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('justice_institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->foreignIdFor(Division::class)->constrained();
            $table->foreignIdFor(City::class)->constrained();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('infractions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serviceperson_number')->constrained('servicepeople', 'number');
            $table->dateTime('occurred_at');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->foreignIdFor(Division::class)->constrained();
            $table->foreignIdFor(City::class)->constrained();
            $table->string('status');
            $table->text('particulars');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Infraction::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SummaryOffenceSection::class)->constrained();
            $table->dateTime('charged_at');
            $table->foreignIdFor(JusticeInstitution::class)->constrained();
            $table->string('charged_by')->nullable();
            $table->timestamps();
        });

        Schema::create('legal_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('legal_taggables', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id');
            $table->morphs('taggable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_taggables');
        Schema::dropIfExists('legal_tags');
        Schema::dropIfExists('charges');
        Schema::dropIfExists('infractions');
        Schema::dropIfExists('police_stations');
        Schema::dropIfExists('summary_offences');
    }
};