<?php

namespace Modules\Registry\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Registry\Database\Factories\TagFactory;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): TagFactory
    {
        return TagFactory::new();
    }

    /**
     * Get the correspondences for the tag.
     */
    public function correspondences(): BelongsToMany
    {
        return $this->belongsToMany(Correspondence::class, 'correspondence_tags');
    }
}
