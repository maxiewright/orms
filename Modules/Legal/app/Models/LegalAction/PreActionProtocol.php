<?php

namespace Modules\Legal\Models\LegalAction;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Legal\Database\Factories\LegalAction\PreActionProtocolFactory;
use Modules\Legal\Enums\LegalAction\PreActionProtocolStatus;
use Modules\Legal\Events\PreActionProtocolReceived;
use Modules\Legal\Models\Ancillary\CourtAppearance\LegalProfessional;
use Modules\Legal\Models\Ancillary\Litigation\PreActionProtocolType;
use Modules\Legal\traits\HasReferences;

class PreActionProtocol extends Model
{
    use HasFactory;
    use HasReferences;
    use SoftDeletes;

    protected $fillable = [
        'subject',
        'pre_action_protocol_type_id',
        'parent_id',
        'dated_at',
        'received_by',
        'received_at',
        'respond_by',
        'status',
        'responded_at',
        'particulars',
    ];

    protected $casts = [
        'dated_at' => 'date:Y-m-d',
        'received_at' => 'datetime:Y-m-d H:i',
        'respond_by' => 'datetime:Y-m-d H:i',
        'responded_at' => 'datetime:Y-m-d H:i',
        'status' => PreActionProtocolStatus::class,
    ];

    protected $appends = ['date'];

    protected static function booted()
    {
        // TODO - Change the status from pending if the responded_at field is not null
        // if is dirty and status is pending set responded at to null
        /**
         * maybe set an alert on the front end to let the user know that  if the
         * status is set to pending the  responded_at field is must be null;
         */
        static::created(function (PreActionProtocol $preActionProtocol) {
            PreActionProtocolReceived::dispatch($preActionProtocol);
        });

    }

    public function claimants(): BelongsToMany
    {
        return $this->belongsToMany(Serviceperson::class, 'serviceperson_pre_action_protocol')
            ->using(ServicepersonPreActionProtocol::class)
            ->withTimestamps();
    }

    public function legalRepresentatives(): BelongsToMany
    {
        return $this->belongsToMany(related: LegalProfessional::class, table: 'legal_professional_pre_action_protocol')
            ->using(LegalProfessionalPreActionProtocol::class)
            ->withTimestamps();
    }

    public function defendants(): BelongsToMany
    {
        return $this->belongsToMany(Defendant::class, 'defendant_pre_action_protocol')
            ->using(DefendantPreActionProtocol::class)
            ->withTimestamps();
    }

    protected static function newFactory(): PreActionProtocolFactory
    {
        return PreActionProtocolFactory::new();
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(PreActionProtocolType::class, 'pre_action_protocol_type_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(PreActionProtocol::class, 'parent_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class, 'received_by');
    }

    public function extensions(): HasMany
    {
        return $this->hasMany(PreActionProtocolExtension::class);
    }

    public function lastExtension(): HasOne
    {
        return $this->hasOne(PreActionProtocolExtension::class)->latestOfMany();
    }

    public function scopeResponded(Builder $query): Builder
    {
        return $query->where('responded_at', '!=', null);
    }

    public function hasResponded(): bool
    {
        return $this->responded_at !== null;
    }

    public function scopeDefaulted(Builder $query): Builder
    {
        return $query->whereDate('respond_by', '>', now())
            ->where('responded_at', null);
    }

    public function hasDefaulted(): bool
    {
        return $this->respond_by->isPast() && $this->responded_at == null;
    }

    public function scopeRespondedLate(Builder $query): Builder
    {
        return $query->whereDate('responded_at', '>', $this->respond_by);
    }

    public function hasLateResponse(): bool
    {
        return $this->responded_at->isAfter($this->respond_by);
    }

    public function scopeResponseImminent(Builder $query): Builder
    {
        return $query->whereDate('respond_by', '<=', now()->addDays(3))
            ->where('responded_at', null);
    }

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->dated_at->format(config('legal.date'))
        );
    }
}
