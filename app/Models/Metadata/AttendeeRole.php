<?php

namespace App\Models\Metadata;

use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendeeRole extends Model
{
    use SluggableByName, SoftDeletes;

    public $guarded = [];
}
