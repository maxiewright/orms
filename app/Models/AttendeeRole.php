<?php

namespace App\Models;

use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendeeRole extends Model
{
    use SluggableByName, SoftDeletes;

    public $guarded = [];
}
