<?php

namespace Modules\Legal\Filament\Clusters\Incident\Resources\OffenceSectionResource\Pages;

use Modules\Legal\Filament\Clusters\Incident\Resources\OffenceSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOffenceSections extends ManageRecords
{
    protected static string $resource = OffenceSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
