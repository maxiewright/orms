<?php

namespace Modules\Legal\Models;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ServicepersonLitigation extends Pivot
{
    protected $fillable = ['serviceperson_number', 'legal_action_id'];

    public function serviceperson(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class);
    }
    public function legalAction(): BelongsTo
    {
        return $this->belongsTo(Litigation::class);
    }
}
