<?php

namespace App\Traits\Serviceperson;

use App\Models\Metadata\Gender;
use App\Models\Metadata\PersonalInformation\Ethnicity;
use App\Models\Metadata\PersonalInformation\MaritalStatus;
use App\Models\Metadata\PersonalInformation\NextOfKinRelationship;
use App\Models\Metadata\PersonalInformation\Religion;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasBasicInformation
{
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function religion(): BelongsTo
    {
        return $this->belongsTo(Religion::class);
    }

    public function maritalStatus(): BelongsTo
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function ethnicity(): BelongsTo
    {
        return $this->belongsTo(Ethnicity::class);
    }

    public function nextOfKinRelationship(): BelongsTo
    {
        return $this->belongsTo(NextOfKinRelationship::class);
    }
}
