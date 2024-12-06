<?php

namespace Modules\Legal\Models;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Legal\Database\Factories\CourtAppearanceFactory;
use Modules\Legal\Enums\CourtAppearance\CourtAppearanceOutcome;
use Modules\Legal\Enums\JusticeInstitutionType;
use Modules\Legal\Models\Ancillary\CourtAppearance\LegalProfessional;
use Modules\Legal\Models\Ancillary\CourtAppearance\ServicepersonCourtAppearance;
use Modules\Legal\Models\Ancillary\JusticeInstitution;

class CourtAppearance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'justice_institution_id',
        'attended_at',
        'accompanied_by',
        'outcome',
        'next_date',
        'parent_id', // 'parent_id' is a foreign key to 'court_appearances' table
        'bail_amount',
        'judge_id',
        'lawyer_id',
        'prosecutor_id',
        'particulars',
    ];

    protected $casts = [
        'attended_at' => 'datetime',
        'next_date' => 'datetime',
        'outcome' => CourtAppearanceOutcome::class,
        'bail_amount' => 'integer',
    ];

    protected static function newFactory(): CourtAppearanceFactory
    {
        return CourtAppearanceFactory::new();
    }

    public function court(): BelongsTo
    {
        return $this->belongsTo(JusticeInstitution::class, 'justice_institution_id')
            ->where('type', JusticeInstitutionType::MagistrateCourt)
            ->orWhere('type', JusticeInstitutionType::FamilyCourt)
            ->orWhere('type', JusticeInstitutionType::HighCourt)
            ->orWhere('type', JusticeInstitutionType::CourtOfAppeal);
    }

    public function servicepeople(): BelongsToMany
    {
        return $this->belongsToMany(Serviceperson::class, 'serviceperson_court_appearance')
            ->using(ServicepersonCourtAppearance::class)
            ->withPivot('infraction_id', 'reason');
    }

    public function servicepeopleCourtAppearances(): HasMany
    {
        return $this->hasMany(ServicepersonCourtAppearance::class);
    }

    public function previousAppearance(): BelongsTo
    {
        return $this->belongsTo(CourtAppearance::class, 'parent_id');
    }

    public function accompaniedBy(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class, 'accompanied_by');
    }

    public function judge(): BelongsTo
    {
        return $this->belongsTo(LegalProfessional::class, 'judge_id');
    }

    public function lawyer(): BelongsTo
    {
        return $this->belongsTo(LegalProfessional::class, 'lawyer_id');
    }

    public function prosecutor(): BelongsTo
    {
        return $this->belongsTo(LegalProfessional::class, 'prosecutor_id');
    }

    public function receivedBail(): bool
    {
        return $this->bail_amount > 0;
    }

    public function scopeAttended(Builder $query): Builder
    {
        return $query->where('attended_at', '>', now());
    }

}
