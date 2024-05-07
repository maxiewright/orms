<?php

namespace Modules\Legal\Filament\Clusters\Legal\Resources\InfractionResource\Pages;

use Modules\Legal\Filament\Clusters\Legal\Resources\InfractionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInfractions extends ListRecords
{
    protected static string $resource = InfractionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
