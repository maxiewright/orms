<?php

namespace Modules\ServiceFund\App\Actions;

use Modules\ServiceFund\App\Models\Reconciliation;
use Modules\ServiceFund\App\Models\Transaction;

class ProcessReconciliationTransactionsAction
{
    /**
     * @throws \Exception
     */
    public function handle(Reconciliation $reconciliation, array $transactions): void
    {
        try {
            foreach ($transactions as $transaction) {
                $this->prepareTransaction($reconciliation, $transaction);

                isset($transaction['id'])
                    ? $this->updateTransaction($reconciliation, $transaction)
                    : $this->createTransaction($reconciliation, $transaction);
            }
        } catch (\Exception $e) {
            $reconciliation->forceDelete();
            throw new \Exception('Reconciliation transaction processing failed: '.$e->getMessage());
        }
    }

    public function prepareTransaction(Reconciliation $reconciliation, array &$transaction): void
    {
        $transaction['account_id'] = $reconciliation->account_id;
        $transaction['executed_at'] = $transaction['execution_date'];
        $transaction['amount_in_cents'] = $transaction['amount'] * 100;
    }

    public function updateTransaction(Reconciliation $reconciliation, array $transaction): void
    {
        Transaction::findOrFail($transaction['id'])
            ->reconciliation()
            ->associate($reconciliation)
            ->update($transaction);
    }

    public function createTransaction(Reconciliation $reconciliation, array $transaction): void
    {
        $reconciliation->transactions()->create($transaction);
    }
}
