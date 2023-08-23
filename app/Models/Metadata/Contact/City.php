<?php

namespace App\Models\Metadata\Contact;

use App\Traits\HasServicepeople;
use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes, HasServicepeople, SluggableByName;

    public $guarded = [];

    protected $with = [
        'division',
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
}
