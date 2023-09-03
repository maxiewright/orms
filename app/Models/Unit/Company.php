<?php

namespace App\Models\Unit;

use App\Models\Department;
use App\Models\Interview;
use App\Traits\HasServicepeople;
use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SluggableByName, SoftDeletes, HasServicepeople;

    public $guarded = [];

    public function battalion(): BelongsTo
    {
        return $this->belongsTo(Battalion::class);
    }

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'company_department');
    }
}
