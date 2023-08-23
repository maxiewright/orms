<?php

namespace App\Traits\Serviceperson;

use App\Models\Metadata\EnlistmentType;
use App\Models\Metadata\Rank;
use App\Models\Metadata\ServiceData\EmploymentStatus;
use App\Models\Unit\Formation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasServiceData
{
    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class);
    }

    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }

    public function enlistmentType(): BelongsTo
    {
        return $this->belongsTo(EnlistmentType::class);
    }

    public function employmentStatus(): BelongsTo
    {
        return $this->belongsTo(EmploymentStatus::class);
    }
}
