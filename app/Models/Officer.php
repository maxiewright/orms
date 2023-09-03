<?php

namespace App\Models;

use App\Filament\Resources\OfficerResource;
use App\Models\Scopes\OfficerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Officer extends Serviceperson
{
    public $guarded = [];

    protected static function booted(): void
    {
        static::addGlobalScope(new OfficerScope);
    }

}
