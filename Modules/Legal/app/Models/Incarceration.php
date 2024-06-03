<?php

namespace Modules\Legal\Models;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Legal\Database\Factories\IncarcerationFactory;
use Modules\Legal\Enums\JusticeInstitutionType;
use Modules\Legal\Models\Ancillary\JusticeInstitution;
use Modules\Legal\traits\HasReferences;

class Incarceration extends Model
{
    use HasFactory;
    use HasReferences;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'incident_id',
        'incarcerated_at',
        'justice_institution_id',
        'released_at',
        'particulars',
    ];

    protected $casts = [
        'incarcerated_at' => 'datetime:Y-m-d H:i',
        'released_at' => 'datetime:Y-m-d H:i',
    ];

    protected static function newFactory(): IncarcerationFactory
    {
        return IncarcerationFactory::new();
    }

    public function incident(): BelongsTo
    {
        return $this->belongsTo(Incident::class);
    }

    public function serviceperson(): HasOneThrough
    {
        return $this->hasOneThrough(
            Serviceperson::class,
            Incident::class,
            'id',
            'number',
            'incident_id',
            'serviceperson_number',
        );
    }

    public function charges(): HasManyThrough
    {
        return $this->hasManyThrough(
            Charge::class,
            Incident::class,
            'id',
            'incident_id',
            'incident_id',
            'id',
        );
    }

    public function correctionalFacility(): BelongsTo
    {
        return $this->belongsTo(JusticeInstitution::class, 'justice_institution_id')
            ->where('type', JusticeInstitutionType::CorrectionalFacility);
    }

    public function scopedReleased(Builder $query)
    {
        $query->where('released_at', '!=', null);
    }

    public function isReleased(): bool
    {
        return $this->released_at !== null;
    }
}
