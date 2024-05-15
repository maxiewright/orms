<?php

namespace Modules\Legal\traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Legal\Models\Charge;
use Modules\Legal\Models\Interdiction;

trait Referenceable
{
    public function charges(): MorphToMany
    {
        return $this->morphToMany(Charge::class, 'referenceable');
    }

    public function interdictions(): MorphToMany
    {
        return $this->morphToMany(Interdiction::class, 'referenceable');
    }
}
