<?php

namespace Modules\Legal\Models\Ancillary\Infraction;

use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Legal\Enums\Incident\OffenceType;
use Modules\Legal\Models\Incident;
use Spatie\Sluggable\HasSlug;

class OffenceDivision extends Model
{
    use HasSlug;
    use SluggableByName;

    protected $fillable = ['type', 'name', 'particulars'];

    protected $casts = ['type' => OffenceType::class];

    public function sections(): HasMany
    {
        return $this->hasMany(OffenceSection::class, 'offence_division_id');
    }

    public function infractions(): HasMany
    {
        return $this->hasMany(Incident::class);
    }
}
