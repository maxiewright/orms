<?php

namespace Modules\Legal\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondence;

class LegalActionReferenceDocument extends Pivot
{
    protected $fillable = ['legal_action_id', 'reference_document_id', 'particulars'];

    public function legalAction(): BelongsTo
    {
        return $this->belongsTo(Litigation::class);
    }

    public function referenceDocument(): BelongsTo
    {
        return $this->belongsTo(LegalCorrespondence::class);
    }
}
