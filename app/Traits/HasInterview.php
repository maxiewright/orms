<?php

namespace App\Traits;

use App\Models\Interview;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasInterview
{
    public function interviews(): BelongsToMany
    {
        return $this->belongsToMany(
            Interview::class,
            'serviceperson_interview',
            'serviceperson_number',
            'interview_id'
        );
    }
}
