<?php

namespace Modules\Registry\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CorrespondenceTag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'correspondence_id',
        'tag_id',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return \Modules\Registry\Database\Factories\CorrespondenceTagFactory::new();
    }

    /**
     * Get the correspondence that owns the tag.
     */
    public function correspondence(): BelongsTo
    {
        return $this->belongsTo(Correspondence::class);
    }

    /**
     * Get the tag that owns the correspondence.
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
