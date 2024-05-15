<?php

namespace Modules\Legal\Models;

use App\Models\Serviceperson;
use App\Traits\HasAddress;
use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Legal\Database\Factories\InfractionFactory;
use Modules\Legal\Enums\IncidentStatus;
use Modules\Legal\Enums\IncidentType;

class Incident extends Model
{
    use HasAddress;
    use HasFactory;
    use SluggableByName;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'type',
        'serviceperson_number',
        'occurred_at',
        'address_line_1',
        'address_line_2',
        'division_id',
        'city_id',
        'status',
        'particulars',
    ];

    protected $casts = [
        'occurred_at' => 'datetime',
        'type' => IncidentType::class,
        'status' => IncidentStatus::class,
    ];

    protected $with = ['city', 'division'];

    protected $appends = ['address'];

    protected static function newFactory(): InfractionFactory
    {
        return InfractionFactory::new();
    }

    public function serviceperson(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class, 'serviceperson_number');
    }

    public function charges(): HasMany
    {
        return $this->hasMany(Charge::class);
    }

    public function wasNotCharged(): bool
    {
        return $this->charges()->doesntExist();
    }


}
