<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Legal\Models\Ancillary\CourtAppearance\LegalProfessionalType;
use Modules\Legal\Models\Ancillary\CourtAppearance\ReleaseCondition;
use Modules\Legal\Models\Ancillary\JusticeInstitution;
use Modules\Legal\Models\CourtAppearance;
use Modules\Legal\Models\Infraction;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('legal_professional_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('legal_professionals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LegalProfessionalType::class)->constrained();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('court_appearances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(JusticeInstitution::class)->constrained();
            $table->dateTime('attended_at')->nullable();
            $table->foreignId('accompanied_by')->nullable()->constrained('servicepeople', 'number');
            $table->string('outcome');
            $table->dateTime('next_date')->nullable();
            $table->integer('bail_amount')->nullable();
            $table->foreignId('judge_id')->nullable()->constrained('legal_professionals');
            $table->foreignId('lawyer_id')->nullable()->constrained('legal_professionals');
            $table->foreignId('prosecutor_id')->nullable()->constrained('legal_professionals');
            $table->text('particulars');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('serviceperson_court_appearance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serviceperson_number')->constrained('servicepeople', 'number');
            $table->foreignIdFor(CourtAppearance::class)->constrained();
            $table->foreignIdFor(Infraction::class)->nullable()->constrained();
            $table->string('reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('release_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('condition');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('court_appearance_release_condition', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CourtAppearance::class);
            $table->foreignIdFor(ReleaseCondition::class);
            $table->text('particulars');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_appearance_release_condition');
        Schema::dropIfExists('release_conditions');
        Schema::dropIfExists('serviceperson_court_appearance');
        Schema::dropIfExists('court_appearances');
        Schema::dropIfExists('courts');
        Schema::dropIfExists('legal_professionals');
        Schema::dropIfExists('legal_professional_types');
    }
};
