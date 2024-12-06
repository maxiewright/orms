<?php

namespace App\Models;

use App\Enums\Serviceperson\PhoneTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PhoneNumber extends Model
{
    use HasFactory;

    public $guarded = [];

    protected function casts(): array
    {
        return [
            'type' => PhoneTypeEnum::class,
        ];
    }

    public function phoneable(): MorphTo
    {
        return $this->morphTo();
    }
}
