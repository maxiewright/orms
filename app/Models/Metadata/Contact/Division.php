<?php

namespace App\Models\Metadata\Contact;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use SoftDeletes;

    public $guarded = [];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(DivisionType::class, 'division_type_id');
    }
}
