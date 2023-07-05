<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('officer_performance_appraisal_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serviceperson_number')
                ->constrained('servicepeople', 'number', 'officer_appraisal_checklist');
            $table->dateTime('appraisal_start_at');
            $table->dateTime('appraisal_end_at');
            $table->boolean('is_appointment_correct');
            $table->boolean('company_commander_assessment_completed')->nullable();
            $table->boolean('has_company_commander_comments')->nullable();
            $table->boolean('has_company_commander_signature')->nullable();
            $table->boolean('has_unit_commander_comments')->nullable();
            $table->boolean('has_unit_commander_signature')->nullable();
            $table->boolean('has_formation_commander_comments')->nullable();
            $table->boolean('has_formation_commander_signature')->nullable();
            $table->boolean('has_serviceperson_signature')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officer_performance_appraisal_checklists');
    }
};
