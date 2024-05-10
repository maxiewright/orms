<?php

namespace Modules\Legal\Filament\Clusters\Ancillary\Resources\LegalTagResource\Pages;

use Modules\Legal\Filament\Clusters\Ancillary\Resources\LegalTagResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLegalTags extends ListRecords
{
    protected static string $resource = LegalTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
