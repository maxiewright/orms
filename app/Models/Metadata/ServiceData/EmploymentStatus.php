<?php

namespace App\Models\Metadata\ServiceData;

use App\Traits\HasServicepeople;
use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmploymentStatus extends Model
{
    use HasServicepeople;
    use SluggableByName;
    use SoftDeletes;
    public $guarded = [];
}
