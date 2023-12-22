<?php

namespace App\Models;

use App\Enums\RankEnum;
use App\Models\Metadata\OfficerAppraisalGrade;
use App\Traits\HasInterview;
use App\Traits\Serviceperson\HasBasicInformation;
use App\Traits\Serviceperson\HasContactInformation;
use App\Traits\Serviceperson\HasServiceData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Serviceperson extends Model
{
    use HasBasicInformation, HasContactInformation, HasFactory, HasInterview, HasServiceData;

    protected $primaryKey = 'number';

    public $incrementing = false;

    protected $table = 'servicepeople';

    protected $guarded = [];

    protected $appends = [
        'military_name',
        'full_military_name',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'enlistment_date' => 'date',
        'assumption_date' => 'date',
    ];

    protected $with = [
        'rank',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function grading(): BelongsTo
    {
        return $this->belongsTo(OfficerAppraisalGrade::class);
    }

    public function officerPerformanceAppraisalChecklists(): HasMany
    {
        return $this->hasMany(OfficerPerformanceAppraisalChecklist::class);
    }

    public function scopeOfficers(Builder $query)
    {
        $query->where('rank_id', '>=', RankEnum::O1);
    }

    protected function militaryName(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->rank_id <= 6)
                ? $this->number.' '.$this->rank->regiment_abbreviation.' '.$this->last_name.' '.substr($this->first_name, 0, 1)
                : $this->number.' '.$this->rank->regiment_abbreviation.' '.substr($this->first_name, 0, 1).' '.$this->last_name
        );
    }

    protected function fullMilitaryName(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->rank_id <= 6)
                ? $this->number.' '.$this->rank->regiment_abbreviation.' '.$this->last_name.', '.$this->first_name
                : $this->number.' '.$this->rank->regiment_abbreviation.' '.$this->first_name.' '.$this->last_name
        );
    }

    public function officerTwoDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->assumption_date->addYears(1)
        );

    }

    public function officerThreeDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->assumption_date->addYears(3)
        );

    }

    public function officerFourDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->assumption_date->addYears(7)
        );

    }

    public function officerFiveDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->assumption_date->addYears(14)
        );

    }
}
