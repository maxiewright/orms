<?php

namespace Modules\Legal\Models;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Legal\Database\Factories\LitigationFactory;
use Modules\Legal\Enums\LegalAction\LitigationCategoryType;
use Modules\Legal\Enums\LegalAction\LitigationStatus;
use Modules\Legal\Enums\LegalAction\LitigationType;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondence;
use Modules\Legal\Models\Ancillary\Litigation\LitigationCategory;
use Modules\Legal\Models\LegalAction\Defendant;
use Modules\Legal\Models\LegalAction\DefendantLitigation;
use Modules\Legal\Models\LegalAction\PreActionProtocol;
use Modules\Legal\Models\LegalAction\ServicepersonLitigation;

class Litigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_number',
        'type_id',
        'status_id',
        'pre_action_protocol_id',
        'reason_id',
        'outcome_id',
        'legal_professional_id',
        'filed_at',
        'started_at',
        'ended_at',
        'damages_awarded',
        'settlement_date',
        'settlement_amount',
        'particulars',
    ];

    protected $casts = [
        'filed_at' => 'datetime:y-m-d:H:i',
        'started_at' => 'datetime:y-m-d:H:i',
        'ended_at' => 'datetime:y-m-d:H:i',
        'settlement_date' => 'datetime:y-m-d:H:i',
        'damages_awarded' => 'integer',
        'settlement_amount' => 'integer',
    ];

    protected static function newFactory(): LitigationFactory
    {
        return LitigationFactory::new();
    }

    // TODO - Generate name/subject from the Case number, complainint, and defendent

    protected static function booted()
    {
        static::saving(function (Litigation $litigation) {
            // get the case number
            // foreach through the complaints
        });
    }

    public function complainants(): BelongsToMany
    {
        return $this->belongsToMany(Serviceperson::class)
            ->using(ServicepersonLitigation::class)
            ->withTimestamps();
    }

    public function defendants(): BelongsToMany
    {
        return $this->belongsToMany(Defendant::class)
            ->using(DefendantLitigation::class)
            ->withTimestamps();
    }

    public function preActionProtocol(): BelongsTo
    {
        return $this->belongsTo(PreActionProtocol::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(LitigationCategory::class, 'type_id')
            ->where('type', LitigationCategoryType::Type);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(LitigationCategory::class, 'status_id')
            ->where('type', LitigationCategoryType::Status);
    }

    public function reason(): BelongsTo
    {
        return $this->belongsTo(LitigationCategory::class, 'reason_id')
            ->where('type', LitigationCategoryType::Reason);
    }

    public function outcome(): BelongsTo
    {
        return $this->belongsTo(LitigationCategory::class, 'outcome_id')
            ->where('type', LitigationCategoryType::Outcome);
    }

    public function referenceDocuments(): BelongsToMany
    {
        return $this->belongsToMany(LegalCorrespondence::class)
            ->using(LegalActionReferenceDocument::class)
            ->withPivot('particulars')
            ->withTimestamps();
    }
}
