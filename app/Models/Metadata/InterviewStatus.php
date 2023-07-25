<?php

namespace App\Models\Metadata;

use App\Models\Interview;
use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterviewStatus extends Model
{
    use SluggableByName, SoftDeletes;

    public $guarded = [];

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
        );
    }
}
