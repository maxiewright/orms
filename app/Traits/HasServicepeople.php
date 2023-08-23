<?php

namespace App\Traits;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasServicepeople
{
    public function servicepeople(): HasMany
    {
        return $this->hasMany(Serviceperson::class);
    }
}
