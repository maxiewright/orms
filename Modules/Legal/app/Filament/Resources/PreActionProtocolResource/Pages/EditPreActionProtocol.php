<?php

namespace Modules\Legal\Filament\Resources\PreActionProtocolResource\Pages;

use Modules\Legal\Filament\Resources\PreActionProtocolResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPreActionProtocol extends EditRecord
{
    protected static string $resource = PreActionProtocolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
