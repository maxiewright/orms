<?php

namespace Modules\ServiceFund\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasAddress
{

    public function address(): Attribute
    {
        return Attribute::make(
            get: fn () => ! $this->address_line_2
                ? $this->address_line_1.', '.$this->city?->name
                : $this->address_line_1.', '.$this->address_line_2.', '.$this->city?->name
        );
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(app(config('servicefund.address.city'))::class, 'city_id');
    }
}
