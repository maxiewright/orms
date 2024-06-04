<?php

namespace Modules\Legal\Models\LegalAction;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ServicepersonPreActionProtocol extends Pivot
{
    protected $fillable = [
        'serviceperson_number',
        'pre_action_protocol_id',
    ];

    public function serviceperson(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class, 'serviceperson_number');
    }

    public function preActionProtocol(): BelongsTo
    {
        return $this->belongsTo(PreActionProtocol::class);
    }
}
