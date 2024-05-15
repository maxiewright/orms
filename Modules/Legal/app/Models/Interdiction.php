<?php

namespace Modules\Legal\Models;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Modules\Legal\Database\Factories\InterdicationFactory;
use Modules\Legal\Enums\InterdictionStatus;
use Modules\Legal\traits\HasReferences;

class Interdiction extends Model
{
    use HasFactory;
    use HasReferences;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'incident_id',
        'requested_at',
        'interdicted_at',
        'lifted_at',
        'status',
        'particulars',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'interdicted_at' => 'datetime',
        'lifted_at' => 'datetime',
        'status' => InterdictionStatus::class,
    ];

    protected static function newFactory(): InterdicationFactory
    {
        return InterdictionFactory::new();
    }

    public function incident(): BelongsTo
    {
        return $this->belongsTo(Incident::class);
    }

    public function serviceperson(): HasOneThrough
    {
        return $this->hasOneThrough(Serviceperson::class, Incident::class);
    }
}
