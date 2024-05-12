<?php

namespace Modules\Legal\Models;

use App\Models\Serviceperson;
use App\Traits\HasAddress;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Legal\Database\Factories\InfractionFactory;
use Modules\Legal\Enums\InfractionStatus;

class Infraction extends Model
{
    use HasAddress;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
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
        'status' => InfractionStatus::class,
    ];

    protected $appends = ['address'];

    protected static function newFactory(): InfractionFactory
    {
        return InfractionFactory::new();
    }

    public function serviceperson(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class, 'serviceperson_number', 'number');
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
