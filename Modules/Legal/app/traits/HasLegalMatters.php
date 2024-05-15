<?php

namespace Modules\Legal\traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Legal\Models\Ancillary\CourtAppearance\ServicepersonCourtAppearance;
use Modules\Legal\Models\CourtAppearance;
use Modules\Legal\Models\Incident;

trait HasLegalMatters
{
    public function incidents(): HasMany
    {
        return $this->hasMany(Incident::class);
    }

    public function courtAppearances(): BelongsToMany
    {
        return $this->belongsToMany(CourtAppearance::class, 'serviceperson_court_appearance')
            ->withPivot('infraction_id', 'reason')
            ->using(ServicepersonCourtAppearance::class);
    }
}
