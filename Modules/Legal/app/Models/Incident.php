<?php

namespace Modules\Legal\Models;

use App\Models\Serviceperson;
use App\Traits\HasAddress;
use App\Traits\SluggableByName;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Legal\Database\Factories\IncidentFactory;
use Modules\Legal\Enums\Incident\IncidentStatus;
use Modules\Legal\Enums\Incident\IncidentType;
use Modules\Legal\traits\HasBasicFilters;

class Incident extends Model
{
    use HasAddress;
    use HasFactory;
    use SluggableByName;
    use SoftCascadeTrait;
    use SoftDeletes;
    use HasBasicFilters;

    protected array $softCascade = ['charges', 'interdiction'];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'type',
        'serviceperson_number',
        'occurred_at',
        'address_line_1',
        'address_line_2',
        'division_id',
        'city_id',
        'status',
        'particulars',
    ];

    protected $casts = [
        'occurred_at' => 'datetime:Y-m-d H:i',
        'type' => IncidentType::class,
        'status' => IncidentStatus::class,
    ];

    protected $with = ['city', 'division'];

    protected $appends = ['address'];

    protected static function newFactory(): IncidentFactory
    {
        return IncidentFactory::new();
    }

    public function serviceperson(): BelongsTo
    {
        return $this->belongsTo(Serviceperson::class, 'serviceperson_number');
    }

    public function charges(): HasMany
    {
        return $this->hasMany(Charge::class);
    }

    public function wasNotCharged(): bool
    {
        return $this->charges()->doesntExist();
    }

    public function date(): Attribute
    {
        return Attribute::get(fn () => $this->occurred_at->format('d M Y'));
    }

    public function interdiction(): HasOne
    {
        return $this->hasOne(Interdiction::class);
    }
}
