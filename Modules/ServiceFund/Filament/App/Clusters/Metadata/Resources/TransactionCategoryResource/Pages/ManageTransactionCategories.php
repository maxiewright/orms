<?php

namespace Modules\ServiceFund\Filament\App\Clusters\Metadata\Resources\TransactionCategoryResource\Pages;

use Modules\ServiceFund\Filament\App\Clusters\Metadata\Resources\TransactionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTransactionCategories extends ManageRecords
{
    protected static string $resource = TransactionCategoryResource::class;

    protected static ?string $title = 'Categories';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
