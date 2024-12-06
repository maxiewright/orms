<?php

namespace Modules\Legal\Models\LegalAction;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Legal\Models\Litigation;

class DefendantLitigation extends Pivot
{
    protected $fillable = [
        'defendant_id',
        'litigation_id',
    ];

    public function defendant(): BelongsTo
    {
        return $this->belongsTo(Defendant::class);
    }

    public function litigation(): BelongsTo
    {
        return $this->belongsTo(Litigation::class);
    }
}
