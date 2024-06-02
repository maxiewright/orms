<?php

namespace Modules\Legal\Models;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Legal\Database\Factories\InterdictionFactory;
use Modules\Legal\Enums\InterdictionStatus;
use Modules\Legal\traits\HasReferences;

class Interdiction extends Model
{
    use HasFactory;
    use HasReferences;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'incident_id',
        'requested_at',
        'interdicted_at',
        'revoked_at',
        'status',
        'particulars',
    ];

    protected $casts = [
        'requested_at' => 'datetime:Y-m-d H:i',
        'interdicted_at' => 'datetime:Y-m-d H:i',
        'lifted_at' => 'datetime:Y-m-d H:i',
        'status' => InterdictionStatus::class,
    ];

    protected static function newFactory(): InterdictionFactory
    {
        return InterdictionFactory::new();
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


}
