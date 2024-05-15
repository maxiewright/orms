<?php

namespace App\Models;

use App\Enums\RankEnum;
use App\Models\Metadata\OfficerAppraisalGrade;
use App\Traits\HasInterview;
use App\Traits\Serviceperson\HasBasicInformation;
use App\Traits\Serviceperson\HasContactInformation;
use App\Traits\Serviceperson\HasForms;
use App\Traits\Serviceperson\HasServiceData;
use App\Traits\Serviceperson\Selectable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Legal\traits\HasLegalMatters;

class Serviceperson extends Model
{
    use HasBasicInformation, HasContactInformation, HasFactory, HasInterview, HasServiceData;
    use HasForms;
    use Selectable;
    use HasLegalMatters;

    protected $primaryKey = 'number';

    public $incrementing = false;

    protected $table = 'servicepeople';

    protected $guarded = [];

    protected $appends = [
        'image_url',
        'military_name',
        'full_military_name',
        'address',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'enlistment_date' => 'date',
        'assumption_date' => 'date',
    ];

    protected $with = [
        'rank', 'formation',
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

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->middle_name)
                ? $this->first_name.' '.$this->middle_name.' '.$this->last_name
                : $this->first_name.' '.$this->last_name
        );
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image ?? $this->defaultImageUrl()
        );
    }

    protected function defaultImageUrl(): string
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
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

    public static function militaryNameSearch(Builder $query, string $search): Builder
    {
        return $query
            ->where('number', 'like', '%'.$search.'%')
            ->orWhere('first_name', 'like', '%'.$search.'%')
            ->orWhere('middle_name', 'like', '%'.$search.'%')
            ->orWhere('last_name', 'like', '%'.$search.'%')
            ->orWhereHas('rank', fn (Builder $query) => $query
                ->where('regiment', 'like', '%'.$search.'%')
                ->orWhere('regiment_abbreviation', 'like', '%'.$search.'%')
                ->orWhere('coast_guard', 'like', '%'.$search.'%')
                ->orWhere('coast_guard_abbreviation', 'like', '%'.$search.'%')
                ->orWhere('air_guard', 'like', '%'.$search.'%')
                ->orWhere('air_guard_abbreviation', 'like', '%'.$search.'%')
                ->orWhere('regiment_abbreviation', 'like', '%'.$search.'%')
                ->orWhere('regiment_abbreviation', 'like', '%'.$search.'%'))
            ->orWhereHas('formation', fn (Builder $query) => $query
                ->where('name', 'like', '%'.$search.'%')
            );
    }
}
