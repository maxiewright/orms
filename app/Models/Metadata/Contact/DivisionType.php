<?php

namespace App\Models\Metadata\Contact;

use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DivisionType extends Model
{
    use SluggableByName, SoftDeletes;

    public $guarded = [];

    public function divisions(): HasMany
    {
        return $this->hasMany(Division::class);
    }
}
