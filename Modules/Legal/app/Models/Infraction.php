<?php

namespace Modules\Legal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Legal\Database\Factories\InfractionFactory;
use Modules\Legal\Enums\InfractionStatus;

class Infraction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $casts = [
        'status' => InfractionStatus::class,
    ];

    protected static function newFactory(): InfractionFactory
    {
        return InfractionFactory::new();
    }
}
