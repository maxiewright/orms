<?php

namespace Modules\Legal\Models\LegalAction;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DefendantPreActionProtocol extends Pivot
{
    protected $fillable = [

    ];

    public function defendant(): BelongsTo
    {
        return $this->belongsTo(Defendant::class);
    }

    public function preActionProtocol(): BelongsTo
    {
        return $this->belongsTo(PreActionProtocol::class);
    }
}
