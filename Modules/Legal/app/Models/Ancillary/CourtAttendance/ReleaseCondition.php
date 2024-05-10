<?php

namespace Modules\Legal\Models\Ancillary\CourtAttendance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Legal\Database\Factories\ReleaseConditionFactory;

class ReleaseCondition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): ReleaseConditionFactory
    {
        //return ReleaseConditionFactory::new();
    }
}
