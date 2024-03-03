<?php

namespace Modules\ServiceFund\Traits;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Modules\ServiceFund\App\Actions\ProcessTransactionAction;
use Modules\ServiceFund\Enums\TransactionType;

trait ProcessesTransactions
{
    protected function handleRecordCreation(array $data): Model
    {
        $processTransaction = new ProcessTransactionAction();

        return $processTransaction($data);
    }


}
