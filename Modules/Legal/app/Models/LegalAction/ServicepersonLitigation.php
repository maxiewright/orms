<?php

namespace Modules\Legal\Models\LegalAction;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Legal\Models\Litigation;

class ServicepersonLitigation extends Pivot
{
    protected $fillable = ['serviceperson_number', 'legal_action_id'];

    public function serviceperson(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class);
    }

    public function litigation(): BelongsTo
    {
        return $this->belongsTo(Litigation::class);
    }
}
