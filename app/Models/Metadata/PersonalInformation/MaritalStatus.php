<?php

namespace App\Models\Metadata\PersonalInformation;

use App\Traits\HasServicepeople;
use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaritalStatus extends Model
{
    use SoftDeletes, HasServicepeople, SluggableByName;

    public $guarded = [];
}
