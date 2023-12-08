<?php

namespace App\Models\Metadata\ServiceData;

use App\Traits\HasServicepeople;
use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobCategory extends Model
{
    use HasServicepeople, SluggableByName, SoftDeletes;

    public $guarded = [];

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }
}
