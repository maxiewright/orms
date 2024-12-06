<?php

namespace Modules\Legal\Models\Ancillary\Litigation;

use App\Traits\SluggableByName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Modules\Legal\Enums\LegalAction\LitigationCategoryType;
use Modules\Legal\Models\Litigation;

class LitigationCategory extends Model
{
    protected $fillable = [
        'type',
        'name',
        'slug',
        'description',
    ];

    protected static function booted(): void
    {
        static::saving(function (LitigationCategory $litigationCategory) {
            $litigationCategory->slug = Str::slug($litigationCategory->type->value.' '.$litigationCategory->name);
        });
    }

    protected $casts = [
        'type' => LitigationCategoryType::class,
    ];

    public function litigations(): HasMany
    {
        return $this->hasMany(Litigation::class);
    }
}
