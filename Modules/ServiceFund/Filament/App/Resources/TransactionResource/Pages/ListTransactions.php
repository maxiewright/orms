<?php

namespace Modules\ServiceFund\Filament\App\Resources\TransactionResource\Pages;

use Modules\ServiceFund\Filament\App\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
