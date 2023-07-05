<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Serviceperson extends Model
{
    use HasFactory;

    protected $primaryKey = 'number';
    public $incrementing = false;

    protected $table = 'servicepeople';
    protected $guarded = [];

    protected $casts = [
        'date_of_birth' => 'date',
        'enlistment_date' => 'date',
        'assumption_date' => 'date',
    ];

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

    public function officerPerformanceAppraisalChecklists(): HasMany
    {
        return $this->hasMany(OfficerPerformanceAppraisalChecklist::class);
    }

    protected function militaryName(): Attribute
    {
        return Attribute::make(
            get: fn() => ($this->rank_id <= 6)
                ? $this->number . ' ' . $this->rank->regiment_abbreviation . ' ' . $this->last_name . ' ' . substr($this->first_name, 0, 1)
                : $this->number . ' ' . $this->rank->regiment_abbreviation . ' ' . substr($this->first_name, 0, 1) . ' ' . $this->last_name
        );
    }

    protected function fullMilitaryName(): Attribute
    {
        return Attribute::make(
            get: fn() => ($this->rank_id <= 6)
                ? $this->number . ' ' . $this->rank->regiment_abbreviation . ' ' . $this->last_name . ', ' . $this->first_name
                : $this->number . ' ' . $this->rank->regiment_abbreviation . ' ' . $this->first_name . ' ' . $this->last_name
        );
    }

    public function officerTwoDate(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->assumption_date->addYears(1)
        );

    }

    public function officerThreeDate(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->assumption_date->addYears(3)
        );

    }

    public function officerFourDate(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->assumption_date->addYears(7)
        );

    }

    public function officerFiveDate(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->assumption_date->addYears(14)
        );

    }


}
