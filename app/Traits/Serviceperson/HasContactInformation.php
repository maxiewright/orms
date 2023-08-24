<?php

namespace App\Traits\Serviceperson;

use App\Models\Email;
use App\Models\Metadata\Contact\City;
use App\Models\PhoneNumber;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasContactInformation
{
    public function phoneNumbers(): MorphMany
    {
        return $this->morphMany(PhoneNumber::class, 'phoneable');
    }

    public function emails(): MorphMany
    {
        return $this->morphMany(Email::class, 'emailable');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
