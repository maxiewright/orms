<?php

namespace Modules\Legal\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Legal\Database\Factories\ChargeFactory;
use Modules\Legal\Models\Ancillary\Infraction\OffenceSection;
use Modules\Legal\Models\Ancillary\JusticeInstitution;

class Charge extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'infraction_id',
        'offence_section_id',
        'charged_at',
        'justice_institution_id',
        'charged_by',
    ];

    protected $casts = [
        'charged_at' => 'datetime',
    ];

    protected static function newFactory(): ChargeFactory
    {
        return ChargeFactory::new();
    }

    public function infraction(): BelongsTo
    {
        return $this->belongsTo(Infraction::class);
    }

    public function offence(): BelongsTo
    {
        return $this->belongsTo(OffenceSection::class, 'offence_section_id');
    }

    public function policeStation(): BelongsTo
    {
        return $this->belongsTo(JusticeInstitution::class, 'justice_institution_id');
    }
}
