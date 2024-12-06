<?php

namespace Modules\Legal\Models\LegalAction;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Legal\Models\CourtAppearance;
use Modules\Legal\Models\Litigation;

class LitigationCourtAppearance extends Pivot
{
    protected $fillable = [
        'litigation_id',
        'court_appearance_id',
    ];

    public function litigation(): BelongsTo
    {
        return $this->belongsTo(Litigation::class);
    }

    public function courtAppearance(): BelongsTo
    {
        return $this->belongsTo(CourtAppearance::class);
    }
}
