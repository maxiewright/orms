<?php

namespace Modules\Registry\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Registry\Database\Factories\CorrespondenceReferencesFactory;
use Modules\Registry\Enums\CorrespondenceReferenceType;

class CorrespondenceReferences extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'source_correspondence_id',
        'related_correspondence_id',
        'reference_type',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'reference_type' => CorrespondenceReferenceType::class,
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return CorrespondenceReferencesFactory::new();
    }

    /**
     * Get the source correspondence.
     */
    public function sourceCorrespondence(): BelongsTo
    {
        return $this->belongsTo(Correspondence::class, 'source_correspondence_id');
    }

    /**
     * Get the related correspondence.
     */
    public function relatedCorrespondence(): BelongsTo
    {
        return $this->belongsTo(Correspondence::class, 'related_correspondence_id');
    }
}
