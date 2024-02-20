<?php

namespace Modules\ServiceFund\Filament\App\Resources\TransactionResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\ServiceFund\Filament\App\Resources\TransactionResource;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['created_by'] = auth()->id();

        return $data;
    }
}
