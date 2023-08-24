<?php

namespace App\Models;

use App\Enums\Serviceperson\EmailTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use SoftDeletes, HasFactory;

    public $guarded = [];

    protected $casts = [
        'type' => EmailTypeEnum::class,
    ];
    public function emailable(): MorphTo
    {
        return $this->morphTo();
    }
}
