<?php

namespace Modules\Legal\Models\LegalAction;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Legal\Models\Ancillary\CourtAppearance\LegalProfessional;

class LegalProfessionalPreActionProtocol extends Pivot
{
    protected $fillable = [
        'legal_professional_id',
        'pre_action_protocol_id',
    ];

    public function legalProfessional(): BelongsTo
    {
        return $this->belongsTo(LegalProfessional::class);
    }

    public function preActionProtocol(): BelongsTo
    {
        return $this->belongsTo(PreActionProtocol::class);
    }
}
