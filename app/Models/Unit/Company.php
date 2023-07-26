<?php

namespace App\Models\Unit;

use App\Models\Interview;
use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SluggableByName, SoftDeletes;

    public $guarded = [];

    public function battalion(): BelongsTo
    {
        return $this->belongsTo(Battalion::class);
    }

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }
}
