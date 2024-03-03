<?php

namespace Modules\ServiceFund\Filament\App\Resources\TransferResource\Pages;

use Modules\ServiceFund\Filament\App\Resources\TransferResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransfer extends EditRecord
{
    protected static string $resource = TransferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
