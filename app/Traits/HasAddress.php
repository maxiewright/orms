<?php

namespace App\Traits;

use App\Models\Metadata\Contact\City;
use App\Models\Metadata\Contact\Division;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasAddress
{

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function address(): Attribute
    {
        return Attribute::make(function () {
            return $this->address_line_2
                ? "{$this->address_line_1}, {$this->address_line_2}, {$this->city->name}"
                : "$this->address_line_1, {$this->city->name}";
        });
    }
}
