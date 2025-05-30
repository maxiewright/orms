<?php

namespace Modules\Registry\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Registry\Enums\CorrespondenceAttachmentType;

class CorrespondenceAttachment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'correspondence_id',
        'name',
        'classification',
        'type',
        'file_path',
        'mime_type',
        'size',
        'is_physical',
        'physical_location',
        'page_count',
        'access_instructions',
        'notes',
        'uploaded_by_user_id',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'type' => CorrespondenceAttachmentType::class,
        'size' => 'integer',
        'is_physical' => 'boolean',
        'page_count' => 'integer',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return \Modules\Registry\Database\Factories\CorrespondenceAttachmentFactory::new();
    }

    /**
     * Get the correspondence that owns the attachment.
     */
    public function correspondence(): BelongsTo
    {
        return $this->belongsTo(Correspondence::class);
    }

    /**
     * Get the user who uploaded the attachment.
     */
    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by_user_id');
    }
}
