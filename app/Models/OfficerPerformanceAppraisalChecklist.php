<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfficerPerformanceAppraisalChecklist extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'appraisal_start_at' => 'datetime',
        'appraisal_end_at' => 'datetime',
        'is_appointment_correct' => 'boolean',
        'is_assessment_rubric_complete' => 'boolean',
        // Company Commander
        'has_company_commander' => 'boolean',
        'has_company_commander_comments' => 'boolean',
        'has_company_commander_signature' => 'boolean',
        // Unit Commander
        'has_unit_commander' => 'boolean',
        'has_unit_commander_comments' => 'boolean',
        'has_unit_commander_signature' => 'boolean',
        // Grading and Discipline
        'has_disciplinary_action' => 'boolean',
        // Formation Commander
        'has_formation_commander_comments' => 'boolean',
        'has_formation_commander_signature' => 'boolean',
        // Serviceperson
        'has_serviceperson_signature' => 'boolean',
    ];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(OfficerAppraisalGrade::class, 'officer_appraisal_grade_id');
    }

    public function scopeCompletedByCompanyCommander(Builder $query): void
    {
        $query->where('is_appointment_correct', true)
            ->where('is_assessment_rubric_complete', true)
            ->where('has_company_commander_comments', true)
            ->where('has_company_commander_signature', true);
    }

    public function completedByCompanyCommander(): bool
    {
        return $this->is_appointment_correct
            && $this->is_assessment_rubric_complete
            && $this->has_company_commander_comments
            && $this->has_company_commander_signature;
    }

    public function scopeCompletedByUnitCommander(Builder $query): void
    {
        $query
            ->where('has_unit_commander_comments', true)
            ->where('has_unit_commander_signature', true);
    }

    public function scopeHasDisciplinaryAction(Builder $query): void
    {
        $query->where('has_disciplinary_action', true);
    }

    public function completedByUnitCommander(): bool
    {
        return $this->has_unit_commander_comments
            && $this->has_unit_commander_signature;
    }

    public function scopeCompletedByFormationCommander(Builder $query): void
    {
        $query
            ->where('has_formation_commander_comments', true)
            ->where('has_formation_commander_signature', true);
    }

    public function completedByFormationCommander(): bool
    {
        return $this->has_formation_commander_comments
            && $this->has_formation_commander_signature;
    }

    public function signedByServiceperson()
    {
        return $this->has_serviceperson_signature;
    }

    public function scopeCompleted(Builder $query): void
    {
        (! $this->has_unit_commander)
            ? $query->completedByCompanyCommander()
                ->completedByFormationCommander()
                ->where('has_serviceperson_signature', true)

            : $query->completedByCompanyCommander()
                ->completedByUnitCommander()
                ->completedByFormationCommander()
                ->where('has_serviceperson_signature', true);

    }

    public function completed(): bool
    {
        return (! $this->has_unit_commander)
            ? $this->completedByCompanyCommander()
            && $this->completedByFormationCommander()
            && $this->signedByServiceperson()

            : $this->completedByCompanyCommander()
            && $this->completedByUnitCommander()
            && $this->completedByFormationCommander()
            && $this->signedByServiceperson();
    }

    public function year(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->appraisal_end_at?->format('Y')
        );
    }

    public function serviceperson(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class);
    }
}
