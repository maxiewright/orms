<?php

namespace Modules\Registry\Models\RegistryIndex;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Modules\Registry\Models\RegistryIndex\IndexSubGroup;
use Modules\Registry\Traits\Sluggable;

use Modules\Registry\Database\Factories\RegirstryIndex\IndexGroupFactory;

class IndexGroup extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'slug'];

    /**
     * Get the sub groups for the index group.
     */
    public function subGroups(): HasMany
    {
        return $this->hasMany(IndexSubGroup::class);
    }

    /**
     * Get the name attribute.
     */
    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
        );
    }

    protected static function newFactory()
    {
        return IndexGroupFactory::new();
    }
}
