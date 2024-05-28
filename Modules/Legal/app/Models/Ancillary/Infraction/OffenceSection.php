<?php

namespace Modules\Legal\Models\Ancillary\Infraction;

use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OffenceSection extends Model
{
    use SluggableByName;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'offence_division_id',
        'section_number',
        'name',
        'particulars',
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(OffenceDivision::class, 'offence_division_id');
    }
}
