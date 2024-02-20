<?php

namespace Modules\ServiceFund\Filament\App\Resources\TransactionResource\Pages;

use Modules\ServiceFund\Filament\App\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
