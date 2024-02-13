<?php

namespace App\Traits\Serviceperson;

use App\Models\Email;
use App\Models\Metadata\Contact\City;
use App\Models\PhoneNumber;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasContactInformation
{
    public function address(): Attribute
    {
        return Attribute::make(function () {
            $city = $this->with('city')->first()?->city?->name;

            if ($this->address_line_2 === null) {
                return $this->address_line_1.', '.$city;
            }

            return $this->address_line_1.', '.$this->address_line_2.' '.$city;
        });
    }

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
