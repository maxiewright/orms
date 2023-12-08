<?php

namespace App\Models;

use App\Models\Metadata\InterviewReason;
use App\Models\Unit\Company;
use App\Traits\HasInterviewStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interview extends Model
{
    use HasFactory, HasInterviewStatus, SoftDeletes;

    public $guarded = [];

    protected $casts = [
        'requested_at' => 'datetime',
        'seen_at' => 'datetime',
        'interview_status' => \App\Enums\Interview\InterviewStatus::class,
    ];

    public function servicepeople(): BelongsToMany
    {
        return $this->belongsToMany(
            Serviceperson::class,
            'serviceperson_interview',
            'interview_id',
            'serviceperson_number'
        );
    }

    public function attendees(): MorphMany
    {
        return $this->morphMany(Attendee::class, 'attendable');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function requestedBy(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class, 'requested_by');
    }

    public function reason(): BelongsTo
    {
        return $this->belongsTo(InterviewReason::class, 'interview_reason_id');
    }

    public function seenBy(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class, 'seen_by');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Interview::class, 'parent_id');
    }
}
