<?php

namespace Modules\Legal\Models\Ancillary\CourtAttendance;

use Google\Service\AnalyticsData\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Legal\Database\Factories\CourtAttendenceReleaseConditionFactory;

class CourtAttendanceReleaseCondition extends Pivot
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): CourtAttendenceReleaseConditionFactory
    {
        //return CourtAttendenceReleaseConditionFactory::new();
    }
}
