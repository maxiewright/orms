<?php

namespace App\Models\Metadata;

use App\Models\Interview;
use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterviewReason extends Model
{
    use SluggableByName, SoftDeletes;

    public $guarded = [];

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }
}
