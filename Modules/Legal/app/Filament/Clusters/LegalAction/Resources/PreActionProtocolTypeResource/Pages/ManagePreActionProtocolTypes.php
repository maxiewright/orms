<?php

namespace Modules\Legal\Filament\Clusters\LegalAction\Resources\PreActionProtocolTypeResource\Pages;

use Modules\Legal\Filament\Clusters\LegalAction\Resources\PreActionProtocolTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePreActionProtocolTypes extends ManageRecords
{
    protected static string $resource = PreActionProtocolTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
