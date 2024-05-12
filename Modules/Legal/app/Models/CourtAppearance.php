<?php

namespace Modules\Legal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Legal\Database\Factories\CourtAppearanceFactory;

class CourtAppearance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): CourtAppearanceFactory
    {
        return CourtAppearanceFactory::new();
    }
}
