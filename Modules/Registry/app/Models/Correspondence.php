<?php

namespace Modules\Registry\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Registry\Database\Factories\CorrespondenceFactory;
use Modules\Registry\Enums\CorrespondencePriority;
use Modules\Registry\Enums\CorrespondenceClassification;
use Modules\Registry\Enums\CorrespondenceDispatchMethod;
use Modules\Registry\Enums\CorrespondenceStatus;
use Modules\Registry\Enums\CorrespondenceType;

class Correspondence extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'file_path',
        'reference_number',
        'external_reference',
        'correspondence_date',
        'slug',
        'subject',
        'body',
        'status',
        'type',
        'classification',
        'priority',
        'security_caveats',
        'response_required',
        'response_due_by',
        'response_to',
        'sender_type',
        'sender_id',
        'sender_location_type',
        'sender_location_id',
        'dispatched_by',
        'dispatch_method',
        'dispatched_at',
        'description',
        'action_required',
        'actioned_at',
        'created_by',
        'updated_by',
    ];

    protected static function newFactory(): CorrespondenceFactory
    {
        return CorrespondenceFactory::new();
    }

    protected $casts = [
        'type' => CorrespondenceType::class,
        'classification' => CorrespondenceClassification::class,
        'priority' => CorrespondencePriority::class,
        'status' => CorrespondenceStatus::class,
        'dispatch_method' => CorrespondenceDispatchMethod::class,
        'correspondence_date' => 'datetime',
        'response_due_by' => 'datetime',
        'dispatched_at' => 'datetime',
        'actioned_at' => 'datetime',
        'response_required' => 'boolean',
    ];

    /**
     * Get the correspondence this is a response to.
     */
    public function responseTo(): BelongsTo
    {
        return $this->belongsTo(Correspondence::class, 'response_to');
    }

    /**
     * Get the responses to this correspondence.
     */
    public function responses(): HasMany
    {
        return $this->hasMany(Correspondence::class, 'response_to');
    }

    /**
     * Get the sender of the correspondence.
     */
    public function sender(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the sender location of the correspondence.
     */
    public function senderLocation(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who dispatched the correspondence.
     */
    public function dispatchedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dispatched_by');
    }

    /**
     * Get the user who created the correspondence.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the correspondence.
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the recipients of the correspondence.
     */
    public function recipients(): HasMany
    {
        return $this->hasMany(CorrespondenceRecipient::class);
    }

    /**
     * Get the references where this correspondence is the source.
     */
    public function sourceReferences(): HasMany
    {
        return $this->hasMany(CorrespondenceReferences::class, 'source_correspondence_id');
    }

    /**
     * Get the references where this correspondence is related.
     */
    public function relatedReferences(): HasMany
    {
        return $this->hasMany(CorrespondenceReferences::class, 'related_correspondence_id');
    }

    /**
     * Get the tags for the correspondence.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'correspondence_tags');
    }

    /**
     * Get the attachments for the correspondence.
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(CorrespondenceAttachment::class);
    }
}
