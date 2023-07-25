<?php

namespace App\Models\Unit;

use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Battalion extends Model
{
    use SluggableByName, SoftDeletes;

    public $guarded = [];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}
