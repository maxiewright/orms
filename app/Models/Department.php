<?php

namespace App\Models;

use App\Models\Unit\Company;
use App\Traits\HasServicepeople;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasServicepeople, SoftDeletes;

    public $guarded = [];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_department');
    }
}
