<?php

namespace App\Models;

use App\Traits\HasServicepeople;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes, HasServicepeople;

    public $guarded = [];
}
