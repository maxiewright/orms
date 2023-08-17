<?php

namespace App\Models\Metadata;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Gender extends Model
{
    use HasSlug, SoftDeletes;

    public $guarded = [];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    
    public function serviceperson(): HasMany
    {
        return $this->hasMany(Serviceperson::class,);
    }
}
