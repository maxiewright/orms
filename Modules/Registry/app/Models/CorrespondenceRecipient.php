<?php

namespace Modules\Registry\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Registry\Enums\CorrespondenceRecipientType;

class CorrespondenceRecipient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'correspondence_id',
        'recipient_type',
        'recipient_id',
        'recipient_location_type',
        'recipient_location_id',
        'type',
        'action_by',
        'action_status',
        'actioned_at',
        'received_by',
        'received_at',
        'viewed_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'type' => CorrespondenceRecipientType::class,
        'action_by' => 'date',
        'actioned_at' => 'datetime',
        'received_at' => 'datetime',
        'viewed_at' => 'datetime',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return \Modules\Registry\Database\Factories\CorrespondenceRecipientFactory::new();
    }

    /**
     * Get the correspondence that owns the recipient.
     */
    public function correspondence(): BelongsTo
    {
        return $this->belongsTo(Correspondence::class);
    }

    /**
     * Get the recipient model.
     */
    public function recipient(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the recipient location model.
     */
    public function recipientLocation(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who received the correspondence.
     */
    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}
