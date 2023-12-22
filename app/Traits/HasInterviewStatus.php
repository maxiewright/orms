<?php

namespace App\Traits;

use App\Enums\Interview\InterviewStatusEnum as InterviewStatusEnum;
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
        $query->where('interview_status_id', InterviewStatusEnum::PENDING);
    }

    public function canceled(Builder $query): void
    {
        $query->where('interview_status_id', InterviewStatusEnum::CANCELED);
    }

    public function seen(Builder $query): void
    {
        $query->where('interview_status_id', InterviewStatusEnum::SEEN);
    }

    public function isPending(): bool
    {
        return $this->interview_status_id === InterviewStatusEnum::PENDING->value;
    }

    public function isCanceled(): bool
    {
        return $this->interview_status_id === InterviewStatusEnum::CANCELED->value;
    }

    public function isSeen(): bool
    {
        return $this->interview_status_id === InterviewStatusEnum::SEEN->value;
    }
}
