<?php

namespace Modules\ServiceFund\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Modules\ServiceFund\App\Models\Transaction;

trait InteractsWithTransactions
{
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Str::ucwords($value),
            set: fn ($value) => Str::lower($value),
        );
    }
}