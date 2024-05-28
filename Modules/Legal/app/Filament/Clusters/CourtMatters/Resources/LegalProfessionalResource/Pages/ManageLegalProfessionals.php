<?php

namespace Modules\Legal\Filament\Clusters\CourtMatters\Resources\LegalProfessionalResource\Pages;

use Modules\Legal\Filament\Clusters\CourtMatters\Resources\LegalProfessionalResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLegalProfessionals extends ManageRecords
{
    protected static string $resource = LegalProfessionalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
