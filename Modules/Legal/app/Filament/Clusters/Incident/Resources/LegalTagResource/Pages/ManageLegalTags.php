<?php

namespace Modules\Legal\Filament\Clusters\Incident\Resources\LegalTagResource\Pages;

use Modules\Legal\Filament\Clusters\Incident\Resources\LegalTagResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLegalTags extends ManageRecords
{
    protected static string $resource = LegalTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
