<?php

namespace App\Models;

use App\Enums\Serviceperson\EmergencyContactTypeEnum;
use App\Models\Metadata\PersonalInformation\Relationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class EmergencyContact extends Model
{
    use HasFactory;

    public $guarded = [];

    protected $casts = [
        'type' => EmergencyContactTypeEnum::class,
    ];

    public function serviceperson(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class, 'serviceperson_number');
    }

    public function relationship(): BelongsTo
    {
        return $this->belongsTo(Relationship::class);
    }

    public function phoneNumbers(): MorphMany
    {
        return $this->morphMany(PhoneNumber::class, 'phoneable');
    }

    public function emails(): MorphMany
    {
        return $this->morphMany(Email::class, 'emailable');
    }
}
