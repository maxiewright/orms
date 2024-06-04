<?php

namespace Modules\Legal\Filament\Resources\PreActionProtocolResource\Pages;

use Modules\Legal\Filament\Resources\PreActionProtocolResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePreActionProtocols extends ManageRecords
{
    protected static string $resource = PreActionProtocolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->slideOver(),
        ];
    }
}
