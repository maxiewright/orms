<?php

namespace Modules\Legal\Filament\Clusters\Correspondence\Resources\LegalCorrespondenceTypeResource\Pages;

use Modules\Legal\Filament\Clusters\Correspondence\Resources\LegalCorrespondenceTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLegalCorrespondenceTypes extends ManageRecords
{
    protected static string $resource = LegalCorrespondenceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
