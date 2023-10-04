<?php

namespace App\Models\Unit;

use App\Models\Interview;
use App\Traits\HasServicepeople;
use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Battalion extends Model
{
    use SluggableByName, SoftDeletes, HasServicepeople;

    public $guarded = [];

    protected $with = [
       'companies'
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function interviews(): HasManyThrough
    {
        return $this->hasManyThrough(Interview::class, Company::class);
    }
}
