<?php

namespace Modules\Legal\Models\Ancillary\CourtAppearance;

use Google\Service\AnalyticsData\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Legal\Database\Factories\CourtAppearanceReleaseConditionFactory;

class CourtAppearanceReleaseCondition extends Pivot
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): CourtAppearanceReleaseConditionFactory
    {
        //return CourtAppearanceReleaseConditionFactory::new();
    }
}
