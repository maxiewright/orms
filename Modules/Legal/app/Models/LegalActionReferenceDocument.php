<?php

namespace Modules\Legal\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Legal\Models\Ancillary\Interdication\ReferenceDocument;

class LegalActionReferenceDocument extends Pivot
{
    protected $fillable = ['legal_action_id', 'reference_document_id', 'particulars'];

    public function legalAction(): BelongsTo
    {
        return $this->belongsTo(LegalAction::class);
    }

    public function referenceDocument(): BelongsTo
    {
        return $this->belongsTo(ReferenceDocument::class);
    }
}
