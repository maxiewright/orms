<?php

namespace Modules\Legal\Filament\Clusters\Ancillary\Resources\LegalCorrespondenceResource\Pages;

use Modules\Legal\Filament\Clusters\Ancillary\Resources\LegalCorrespondenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLegalCorrespondences extends ListRecords
{
    protected static string $resource = LegalCorrespondenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
