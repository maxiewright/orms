<?php

namespace Modules\ServiceFund\App\Actions;

use Illuminate\Support\Facades\DB;
use Modules\ServiceFund\App\Events\TransferCompleted;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\App\Models\Transfer;
use Modules\ServiceFund\Enums\TransactionType;

class ProcessTransferAction
{
    public function __invoke(array $data): Transfer
    {

        $transfer = new Transfer();

        DB::transaction(function () use ($data, $transfer) {

            $creditTransaction = $this->createTransferTransaction(TransactionType::CreditTransfer, $data);

            $debitTransaction = $this->createTransferTransaction(TransactionType::DebitTransfer, $data);

            $transfer->credit_transaction_id = $creditTransaction->id;
            $transfer->debit_transaction_id = $debitTransaction->id;
            $transfer->transferred_at = $data['executed_at'];
            $transfer->save();

            TransferCompleted::dispatch($transfer);


        });

        return $transfer;

    }

    private function createTransferTransaction($type, $data): Transaction
    {
        $accountId = ($type === TransactionType::CreditTransfer)
            ? $data['credit_account_id']
            : $data['debit_account_id'];

        $transaction = Transaction::create([
            'account_id' => $accountId,
            'type' => $type,
            'executed_at' => $data['executed_at'],
            'amount_in_cents' => $data['amount_in_cents'],
            'payment_method' => $data['payment_method'],
            'particulars' => $data['particulars'] ?? null,
            'transactional_type' => $data['transactional_type'],
            'transactional_id' => $data['transactional_id'],
            'created_by' => $data['created_by'],
        ]);

        if (isset($data['categories'])) {
            $transaction->categories()->sync($data['categories']);
        }

        return $transaction;

    }
}
