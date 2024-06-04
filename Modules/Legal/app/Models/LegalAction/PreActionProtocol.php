<?php

namespace Modules\Legal\Models\LegalAction;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Legal\Database\Factories\PreActionProtocolFactory;
use Modules\Legal\Enums\LegalAction\PreActionProtocolStatus;
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
    ];

    protected $casts = [
        'dated_at' => 'date:Y-m-d',
        'received_at' => 'datetime:Y-m-d H:i',
        'respond_by' => 'datetime:Y-m-d H:i',
        'responded_at' => 'datetime:Y-m-d H:i',
        'status' => PreActionProtocolStatus::class,
    ];

    // TODO - Generate name/subject from the Case number, complainint, and defendent

    protected static function booted()
    {
        static::saving(function (PreActionProtocol $preActionProtocol) {
            // get the case number
            // foreach through the complaints
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
}
