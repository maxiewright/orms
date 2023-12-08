<?php

namespace App\Models;

use App\Models\Scopes\OfficerScope;

class Officer extends Serviceperson
{
    public $guarded = [];

    protected static function booted(): void
    {
        static::addGlobalScope(new OfficerScope);
    }
}
