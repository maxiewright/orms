<?php

namespace Modules\Legal\traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Legal\Models\Ancillary\CourtAppearance\ServicepersonCourtAppearance;
use Modules\Legal\Models\CourtAppearance;
use Modules\Legal\Models\Incident;
use Modules\Legal\Models\Interdiction;
use Modules\Legal\Models\Litigation;
use Modules\Legal\Models\ServicepersonLitigation;

trait HasLegalMatters
{
    public function incidents(): HasMany
    {
        return $this->hasMany(Incident::class);
    }

    public function interdictions(): HasMany
    {
        return $this->hasMany(Interdiction::class);
    }

    public function courtAppearances(): BelongsToMany
    {
        return $this->belongsToMany(CourtAppearance::class, 'serviceperson_court_appearance')
            ->withPivot('infraction_id', 'reason')
            ->using(ServicepersonCourtAppearance::class);
    }

    public function legalActions(): BelongsToMany
    {
        return $this->belongsToMany(Litigation::class)
            ->using(ServicepersonLitigation::class);
    }
}
