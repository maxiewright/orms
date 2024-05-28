<?php

namespace Modules\Legal\Filament\Clusters\Incident\Resources\OffenceDivisionsResource\Pages;

use Modules\Legal\Filament\Clusters\Incident\Resources\OffenceDivisionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOffenceDivisions extends ManageRecords
{
    protected static string $resource = OffenceDivisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
