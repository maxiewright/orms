<?php

namespace Modules\Legal\Filament\Clusters\Incident\Resources\JusticeInstitutionResource\Pages;

use Modules\Legal\Filament\Clusters\Incident\Resources\JusticeInstitutionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageJusticeInstitutions extends ManageRecords
{
    protected static string $resource = JusticeInstitutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
