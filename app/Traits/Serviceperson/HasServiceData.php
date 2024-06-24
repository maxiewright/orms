<?php

namespace App\Traits\Serviceperson;

use App\Enums\RankEnum;
use App\Enums\ServiceData\FormationEnum;
use App\Models\Department;
use App\Models\Metadata\EnlistmentType;
use App\Models\Metadata\Rank;
use App\Models\Metadata\ServiceData\EmploymentStatus;
use App\Models\Metadata\ServiceData\Job;
use App\Models\Unit\Battalion;
use App\Models\Unit\Company;
use App\Models\Unit\Formation;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasServiceData
{
    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class);
    }

    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }

    public function enlistmentType(): BelongsTo
    {
        return $this->belongsTo(EnlistmentType::class);
    }

    public function employmentStatus(): BelongsTo
    {
        return $this->belongsTo(EmploymentStatus::class);
    }

    public function battalion(): BelongsTo
    {
        return $this->belongsTo(Battalion::class);
    }

    public function battalionShortName(): Attribute
    {
        return Attribute::get(fn () => $this->battalion?->short_name);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function companyShortName(): Attribute
    {
        return Attribute::get(fn () => $this->company?->short_name);
    }

    public function battalionAndCompanyShortName(): Attribute
    {
        return Attribute::get(function () {
            if ($this->battalion && $this->company) {
                return $this->battalion?->short_name.' - '.$this->company?->short_name;
            }

            if ($this->battalion && ! $this->company) {
                return $this->battalion?->short_name;
            }

            return 'No unit data on record';
        });
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    protected function militaryName(): Attribute
    {
        $rank = $this->getAbbreviatedRank();

        return Attribute::make(
            get: fn () => ($this->rank_id <= RankEnum::E6->value)
                ? $this->number.' '.$rank.' '.$this->last_name.' '.substr($this->first_name, 0, 1)
                : $this->number.' '.$rank.' '.substr($this->first_name, 0, 1).' '.$this->last_name
        );
    }

    protected function fullMilitaryName(): Attribute
    {
        $rank = $this->getRank();

        return Attribute::make(
            get: fn () => ($this->rank_id <= RankEnum::E6->value)
                ? $this->number.' '.$rank.' '.$this->last_name.', '.$this->first_name
                : $this->number.' '.$rank.' '.$this->first_name.' '.$this->last_name
        );
    }

    private function getAbbreviatedRank()
    {
        if ($this->formation->id === FormationEnum::CoastGuard->value) {
            return $this->rank?->coast_guard_abbreviation;
        }

        if ($this->formation->id === FormationEnum::AirGuard->value) {
            return $this->rank?->air_guard_abbreviation;
        }

        return $this->rank?->regiment_abbreviation;

    }

    private function getRank()
    {
        if ($this->formation->id === FormationEnum::CoastGuard->value) {
            return $this->rank?->coast_guard;
        }

        if ($this->formation->id === FormationEnum::AirGuard->value) {
            return $this->rank?->air_guard;
        }

        return $this->rank?->regiment;
    }
}
