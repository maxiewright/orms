<?php

namespace Modules\Registry\Models\RegistryIndex;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Modules\Registry\Models\RegistryIndex\IndexGroup;
use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Modules\Registry\Traits\Sluggable;

use Modules\Registry\Database\Factories\RegirstryIndex\IndexSubGroupFactory;

class IndexSubGroup extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['reference_number', 'name', 'slug', 'index_group_id'];

    /**
     * Get the index group that owns the sub group.
     */
    public function indexGroup(): BelongsTo
    {
        return $this->belongsTo(IndexGroup::class);
    }

    /**
     * Get the subjects for the sub group.
     */
    public function subjects(): HasMany
    {
        return $this->hasMany(IndexSubject::class);
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
        return IndexSubGroupFactory::new();
    }
}
