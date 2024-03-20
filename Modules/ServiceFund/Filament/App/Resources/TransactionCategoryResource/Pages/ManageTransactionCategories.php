<?php

namespace Modules\ServiceFund\Filament\App\Resources\TransactionCategoryResource\Pages;

use Modules\ServiceFund\Filament\App\Resources\TransactionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTransactionCategories extends ManageRecords
{
    protected static string $resource = TransactionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
