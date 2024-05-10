<?php

namespace App\Models\Metadata;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rank extends Model
{
    use HasFactory;

    protected $guarded = [];

//    protected $casts = [
//
//    ];

    public function servicepeople(): HasMany
    {
        return $this->hasMany(Serviceperson::class);
    }
}
