<?php

namespace App\Models;

use App\Models\Metadata\OfficerAppraisalGrade;
use App\Models\Metadata\Rank;
use App\Models\Unit\Battalion;
use App\Traits\HasCompletionElements;
use App\Traits\HasCompletionScopes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfficerPerformanceAppraisalChecklist extends Model
{
    use HasCompletionElements, HasCompletionScopes, HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'appraisal_start_at' => 'datetime',
            'appraisal_end_at' => 'datetime',
            'is_appointment_correct' => 'boolean',
            'is_assessment_rubric_complete' => 'boolean',
            'has_company_commander' => 'boolean',
            'has_company_commander_comments' => 'boolean',
            'has_company_commander_signature' => 'boolean',
            'has_unit_commander' => 'boolean',
            'has_unit_commander_comments' => 'boolean',
            'has_unit_commander_signature' => 'boolean',
            'has_disciplinary_action' => 'boolean',
            'has_formation_commander_comments' => 'boolean',
            'has_formation_commander_signature' => 'boolean',
            'has_serviceperson_signature' => 'boolean',
        ];
    }

    public function serviceperson(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class);
    }

    public function battalion(): BelongsTo
    {
        return $this->belongsTo(Battalion::class, 'battalion_id');
    }

    public function substantiveRank(): BelongsTo
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(OfficerAppraisalGrade::class, 'officer_appraisal_grade_id');
    }

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->completed() ? 'Completed' : 'Incomplete'
        );
    }

    public function year(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->appraisal_end_at?->format('Y')
        );
    }
}
