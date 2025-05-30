<?php

namespace Modules\Registry\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Registry\Database\Factories\CorrespondenceRoutingFactory;
use Modules\Registry\Enums\CorrespondenceRoutingStatus;
use Modules\Registry\Enums\CorrespondenceRoutingActionOutcome;

class CorrespondenceRouting extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'correspondence_id',
        'parent_id',
        'routed_by_type',
        'routed_by_id',
        'routed_to_type',
        'routed_to_id',
        'routing_at',
        'purpose',
        'instructions_or_initial_remarks',
        'status',
        'received_by',
        'received_at',
        'action_taken_remarks',
        'action_outcome',
        'actioned_at',
        'bring_up_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'status' => CorrespondenceRoutingStatus::class,
        'action_outcome' => CorrespondenceRoutingActionOutcome::class,
        'routing_at' => 'datetime',
        'received_at' => 'datetime',
        'actioned_at' => 'datetime',
        'bring_up_at' => 'datetime',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): CorrespondenceRoutingFactory
    {
        return CorrespondenceRoutingFactory::new();
    }

    /**
     * Get the correspondence that owns the routing.
     */
    public function correspondence(): BelongsTo
    {
        return $this->belongsTo(Correspondence::class);
    }

    /**
     * Get the parent routing.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(CorrespondenceRouting::class, 'parent_id');
    }

    /**
     * Get the child routings.
     */
    public function children(): HasMany
    {
        return $this->hasMany(CorrespondenceRouting::class, 'parent_id');
    }

    /**
     * Get the entity that routed the correspondence.
     */
    public function routedBy(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the entity that the correspondence was routed to.
     */
    public function routedTo(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who received the routing.
     */
    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}
