<?php

namespace Modules\Legal\Models\Ancillary\Litigation;

use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Legal\Models\Litigation;

class LitigationRuling extends Model
{
    use SluggableByName;

    protected $fillable = ['name', 'slug', 'description'];

    public function litigations(): HasMany
    {
        return $this->hasMany(Litigation::class);
    }
}
