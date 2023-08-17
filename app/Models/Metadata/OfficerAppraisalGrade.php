<?php

namespace App\Models\Metadata;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class OfficerAppraisalGrade extends Model
{
    use HasSlug;

    public $guarded = [];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function servicepeople(): HasMany
    {
        return $this->hasMany(Serviceperson::class);
    }
}
