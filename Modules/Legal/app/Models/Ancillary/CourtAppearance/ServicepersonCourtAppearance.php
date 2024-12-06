<?php

namespace Modules\Legal\Models\Ancillary\CourtAppearance;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Legal\Enums\CourtAppearance\CourtAppearanceReason;
use Modules\Legal\Models\CourtAppearance;
use Modules\Legal\Models\Incident;

class ServicepersonCourtAppearance extends Pivot
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'serviceperson_number',
        'court_appearance_id',
        'incident_id',
        'reason',
    ];

    protected $casts = ['reason' => CourtAppearanceReason::class];

    public function serviceperson(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class, 'serviceperson_number');
    }
    public function courtAppearance(): BelongsTo
    {
        return $this->belongsTo(CourtAppearance::class);
    }

    public function incident(): BelongsTo
    {
        return $this->belongsTo(Incident::class);
    }



}
