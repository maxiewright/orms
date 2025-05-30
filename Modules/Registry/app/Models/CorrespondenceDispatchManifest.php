<?php

namespace Modules\Registry\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Registry\Database\Factories\CorrespondenceDispatchManifestFactory;
use Modules\Registry\Enums\CorrespondenceDispatchManifestStatus;

class CorrespondenceDispatchManifest extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'reference_number',
        'destination_type',
        'destination_id',
        'prepared_by',
        'prepared_at',
        'status',
        'courier_id',
        'courier_collected_at',
        'courier_delivered_at',
        'received_by',
        'received_at',
        'scanned_form_path',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'status' => CorrespondenceDispatchManifestStatus::class,
        'prepared_at' => 'datetime',
        'courier_collected_at' => 'datetime',
        'courier_delivered_at' => 'datetime',
        'received_at' => 'datetime',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): CorrespondenceDispatchManifestFactory
    {
        return CorrespondenceDispatchManifestFactory::new();
    }

    /**
     * Get the destination entity.
     */
    public function destination(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who prepared the manifest.
     */
    public function preparedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }

    /**
     * Get the courier who delivered the manifest.
     */
    public function courier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'courier_id');
    }

    /**
     * Get the user who received the manifest.
     */
    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    /**
     * Get the dispatches for the manifest.
     */
    public function dispatches(): HasMany
    {
        return $this->hasMany(CorrespondenceDispatch::class, 'correspondence_dispatch_manifest_id');
    }
}
