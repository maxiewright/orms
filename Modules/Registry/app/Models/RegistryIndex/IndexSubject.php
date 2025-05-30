<?php

namespace Modules\Registry\Models\RegistryIndex;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Modules\Registry\Models\RegistryIndex\IndexGroup;
use Modules\Registry\Models\RegistryIndex\IndexSubGroup;
use Modules\Registry\Traits\Sluggable;

use Modules\Registry\Database\Factories\RegirstryIndex\IndexSubjectFactory;

class IndexSubject extends Model
{
    use HasFactory;
    use Sluggable;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['reference_number', 'name', 'slug', 'index_sub_group_id'];

    /**
     * Get the group that owns the subject.
     */
    public function indexGroup(): HasOneThrough
    {
        return $this->hasOneThrough(
            IndexGroup::class,
            IndexSubGroup::class,
            'id',
            'id',
            'index_sub_group_id',
            'index_group_id'
        );
    }

    /**
     * Get the sub group that owns the subject.
     */
    public function indexSubGroup(): BelongsTo
    {
        return $this->belongsTo(IndexSubGroup::class);
    }

    /**
     * Get the name attribute.
     */
    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value): string => ucfirst($value),
        );
    }

    protected static function newFactory()
    {
        return IndexSubjectFactory::new();
    }
}
