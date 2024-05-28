<?php

namespace Modules\Legal\Filament\Clusters\Correspondence\Resources\LegalCorrespondenceResource\Pages;

use Modules\Legal\Filament\Clusters\Correspondence\Resources\LegalCorrespondenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLegalCorrespondences extends ManageRecords
{
    protected static string $resource = LegalCorrespondenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
