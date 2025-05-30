<?php

namespace Modules\Registry\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Registry\Database\Factories\CorrespondenceDispatchFactory;
use Modules\Registry\Enums\CorrespondenceDispatchMethod;
use Modules\Registry\Enums\CorrespondenceDispatchStatus;

class CorrespondenceDispatch extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'correspondence_recipient_id',
        'method',
        'correspondence_dispatch_manifest_id',
        'actioned_by',
        'actioned_at',
        'status',
        'recipient_received_at',
        'receipt_acknowledged_by',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'method' => CorrespondenceDispatchMethod::class,
        'status' => CorrespondenceDispatchStatus::class,
        'actioned_at' => 'datetime',
        'recipient_received_at' => 'datetime',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): CorrespondenceDispatchFactory
    {
        return CorrespondenceDispatchFactory::new();
    }

    /**
     * Get the correspondence recipient that owns the dispatch.
     */
    public function correspondenceRecipient(): BelongsTo
    {
        return $this->belongsTo(CorrespondenceRecipient::class);
    }

    /**
     * Get the dispatch manifest that owns the dispatch.
     */
    public function dispatchManifest(): BelongsTo
    {
        return $this->belongsTo(CorrespondenceDispatchManifest::class, 'correspondence_dispatch_manifest_id');
    }

    /**
     * Get the user who actioned the dispatch.
     */
    public function actionedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actioned_by');
    }

    /**
     * Get the user who acknowledged receipt of the dispatch.
     */
    public function receiptAcknowledgedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receipt_acknowledged_by');
    }
}
