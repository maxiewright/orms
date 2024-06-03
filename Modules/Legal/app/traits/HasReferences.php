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
            ->relationship(name: 'references', titleAttribute: 'name')
            ->createOptionForm(LegalCorrespondence::getForm())
            ->label('Reference Documents')
            ->searchable(['reference', 'date', 'subject'])
            ->multiple()
            ->preload();
    }
}
