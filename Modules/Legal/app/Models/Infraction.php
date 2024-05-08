<?php

namespace Modules\Legal\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Legal\Database\Factories\InfractionFactory;
use Modules\Legal\Enums\InfractionStatus;

class Infraction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'accused_id',
        'occurred_at',
        'address_line_1',
        'address_line_2',
        'country_id',
        'state_id',
        'city_id',
        'status',
        'particulars',
    ];

    protected $casts = [
        'status' => InfractionStatus::class,
    ];

    protected static function newFactory(): InfractionFactory
    {
        return InfractionFactory::new();
    }

    public function accused(): BelongsTo
    {
        return $this->belongsTo(config('legal.accused.class'), 'accused_id');
    }
}
