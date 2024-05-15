<?php

namespace Modules\Legal\traits;

use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondence;

trait HasReferences
{
    public function references(): MorphToMany
    {
        return $this->morphToMany(LegalCorrespondence::class, 'referenceable');
    }

    public static function getReferences()
    {
        return Select::make('references')
            ->relationship('references', 'name')
            ->createOptionForm(LegalCorrespondence::getForm())
            ->label('Reference Documents')
            ->searchable()
            ->multiple()
            ->preload();
    }
}
