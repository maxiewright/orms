<?php

namespace Modules\Legal\Models\LegalAction;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DefendantPreActionProtocol extends Pivot
{
    protected $fillable = [
        'defendant_id',
        'pre_action_protocol_id',
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
