<?php

namespace App\Models;

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
        'company_commander_assessment_completed' => 'boolean',
        'has_company_commander_comments' => 'boolean',
        'has_company_commander_signature' => 'boolean',
        'has_unit_commander_comments' => 'boolean',
        'has_unit_commander_signature' => 'boolean',
        'has_formation_commander_comments' => 'boolean',
        'has_formation_commander_signature' => 'boolean',
        'has_serviceperson_signature' => 'boolean',
    ];

    public function isCompletedByCompanyCommander(): bool
    {
        return $this->is_appointment_correct
            && $this->company_commander_assessment_completed
            && $this->has_company_commander_comments
            && $this->has_company_commander_signature;
    }

    public function isCompletedByUnitCommander(): bool
    {
        return $this->has_unit_commander_comments
            && $this->has_unit_commander_signature;
    }

    public function isCompletedByFormationCommander(): bool
    {
        return $this->has_formation_commander_comments
            && $this->has_formation_commander_signature;
    }

    public function isSignedByServiceperson()
    {
        return $this->has_serviceperson_signature;
    }

    public function hasNoCompanyCommander(): bool
    {
        return !$this->isCompletedByCompanyCommander()
            && $this->isCompletedByUnitCommander();
    }

    public function hasNoUnitCommander(): bool
    {
        return !$this->isCompletedByCompanyCommander()
            && !$this->isCompletedByUnitCommander()
            && $this->isCompletedByFormationCommander();
    }

    public function isComplete(): bool
    {
        return $this->isCompletedByCompanyCommander()
            && $this->isCompletedByUnitCommander()
            && $this->isCompletedByFormationCommander()
            && $this->isSignedByServiceperson();
    }


    public function year(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->appraisal_end_at?->format('Y')
        );
    }

    public function serviceperson(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class);
    }
}
