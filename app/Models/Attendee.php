<?php

namespace App\Models;

use App\Models\Metadata\AttendeeRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendee extends Model
{
    use HasFactory, SoftDeletes;

    public $guarded = [];

    public function attendable(): MorphTo
    {
        return $this->morphTo();
    }

    public function serviceperson(): BelongsTo
    {
        return $this->belongsTo(
            Serviceperson::class,
            'serviceperson_number', ''
        );
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(AttendeeRole::class, 'attendee_role_id');
    }
}
