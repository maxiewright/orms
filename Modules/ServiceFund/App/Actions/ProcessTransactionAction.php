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

            $transaction->account_id = $data['account_id'];
            $transaction->type = $data['type'];
            $transaction->executed_at = $data['executed_at'];
            $transaction->amount_in_cents = $data['amount_in_cents'];
            $transaction->payment_method = $data['payment_method'];
            $transaction->transactional_type = $data['transactional_type'];
            $transaction->transactional_id = $data['transactional_id'];
            $transaction->created_by = $data['created_by'];
            $transaction->particulars = $data['particulars'] ?? null;

            $transaction->save();

            if (isset($data['categories'])) {
                $transaction->categories()->attach($data['categories']);
            }

            TransactionCreated::dispatch($transaction);

        });

        return $transaction;

    }
}
