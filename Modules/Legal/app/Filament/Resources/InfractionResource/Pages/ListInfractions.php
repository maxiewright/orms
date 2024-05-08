<?php

namespace Modules\Legal\Filament\Resources\InfractionResource\Pages;

use Modules\Legal\Filament\Resources\InfractionResource;
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
