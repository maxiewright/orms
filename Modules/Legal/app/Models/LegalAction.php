<?php

namespace Modules\Legal\Models;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Legal\Database\Factories\LegalActionFactory;
use Modules\Legal\Enums\LegalActionStatus;
use Modules\Legal\Enums\LegalActionType;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondence;

class LegalAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'status',
        'started_at',
        'respond_by',
        'responded_at',
        'ended_at',
        'particulars',
    ];

    protected $casts = [
        'type' => LegalActionType::class,
        'status' => LegalActionStatus::class,
        'started_at' => 'datetime',
        'respond_by' => 'datetime',
        'responded_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    protected static function newFactory(): LegalActionFactory
    {
        return LegalActionFactory::new();
    }

    public function servicepeople(): BelongsToMany
    {
        return $this->belongsToMany(Serviceperson::class)
            ->using(ServicepersonLegalAction::class)
            ->withTimestamps();
    }

    public function referenceDocuments(): BelongsToMany
    {
        return $this->belongsToMany(LegalCorrespondence::class)
            ->using(LegalActionReferenceDocument::class)
            ->withPivot('particulars')
            ->withTimestamps();
    }

    public function response(): string
    {
        if ($this->repond_at->isPast()) {
            return 'Responded';
        }

        return 'Pending';
    }

    public function scopePending(Builder $query): Builder
    {
        return $query
            ->where('respond_by', '>', now())
            ->where('responded_at', null);
    }

    public function scoreOverdue(Builder $query): Builder
    {
        return $query
            ->where('respond_at', '<', now())
            ->where('responded_at', null);
    }

    public function scopeResponded(Builder $query): Builder
    {
        return $query->whereNotNull('responded_at');
    }

}
