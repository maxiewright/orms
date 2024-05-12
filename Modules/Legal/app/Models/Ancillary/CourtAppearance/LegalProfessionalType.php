<?php

namespace Modules\Legal\Models\Ancillary\CourtAppearance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Legal\Database\Factories\LegalProfesionalTypeFactory;

class LegalProfessionalType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): LegalProfesionalTypeFactory
    {
        //return LegalProfesionalTypeFactory::new();
    }
}
