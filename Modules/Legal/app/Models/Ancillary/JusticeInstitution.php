<?php

namespace Modules\Legal\Models\Ancillary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Legal\Database\Factories\JusticeInstitutionFactory;
use Modules\Legal\Enums\JusticeInstitutionType;

class JusticeInstitution extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): JusticeInstitutionFactory
    {
        return JusticeInstitutionFactory::new();
    }

    protected $casts = [
        'type' => JusticeInstitutionType::class,
    ];
}
