<?php

namespace App\Traits;

use App\Enums\Interview\InterviewStatus as InterviewStatusEnum;
use App\Models\Metadata\InterviewStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasInterviewStatus
{
    public function status(): BelongsTo
    {
        return $this->belongsTo(InterviewStatus::class, 'interview_status_id');
    }

    public function pending(Builder $query): void
    {
        $query->where('interview_status_id', InterviewStatusEnum::pending);
    }

    public function canceled(Builder $query): void
    {
        $query->where('interview_status_id', InterviewStatusEnum::canceled);
    }

    public function seen(Builder $query): void
    {
        $query->where('interview_status_id', InterviewStatusEnum::seen);
    }

    public function isPending(): bool
    {
        return $this->interview_status_id === InterviewStatusEnum::pending->value;
    }

    public function isCanceled(): bool
    {
        return $this->interview_status_id === InterviewStatusEnum::canceled->value;
    }

    public function isSeen(): bool
    {
        return $this->interview_status_id === InterviewStatusEnum::seen->value;
    }
}
