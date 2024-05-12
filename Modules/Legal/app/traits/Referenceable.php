<?php

namespace Modules\Legal\traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Legal\Models\Charge;

trait Referenceable
{
    public function charges(): MorphToMany
    {
        return $this->morphToMany(Charge::class, 'referenceable');
    }
}
