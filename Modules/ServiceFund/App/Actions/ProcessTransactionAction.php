<?php

namespace Modules\ServiceFund\App\Actions;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\ServiceFund\App\Events\TransactionCreated;
use Modules\ServiceFund\App\Models\Transaction;

class ProcessTransactionAction
{
    /**
     * @throws Exception
     */
    public function __invoke(array $data): Transaction
    {
        $transaction = new Transaction();

        DB::transaction(function () use ($transaction, $data) {

            $transaction->create($data)
                ->categories()
                ->attach($data['categories']);

            TransactionCreated::dispatch($transaction);

        });

        return $transaction;

    }
}
