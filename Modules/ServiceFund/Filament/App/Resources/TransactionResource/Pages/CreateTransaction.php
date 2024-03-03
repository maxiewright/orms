<?php

namespace Modules\ServiceFund\Filament\App\Resources\TransactionResource\Pages;

use Exception;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\ServiceFund\App\Actions\ProcessTransactionAction;
use Modules\ServiceFund\Filament\App\Resources\TransactionResource;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['created_by'] = auth()->id();

        return $data;
    }

    /**
     * @throws Exception
     */
    protected function handleRecordCreation(array $data): Model
    {
        $processTransaction = new ProcessTransactionAction();

        return $processTransaction($data);
    }
}
