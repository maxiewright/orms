<?php

namespace Modules\ServiceFund\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\App\Models\Transfer;
use Modules\ServiceFund\Enums\TransactionType;

class TransferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Transfer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $account = Account::factory()->create();
        $amount = fake()->randomFloat();

        return [
            'credit_transaction_id' => Transaction::factory()->create([
                'account_id' => $account->id,
                'amount' => $amount,
                'type' => TransactionType::CreditTransfer,
            ]),
            'debit_transaction_id' => Transaction::factory()->create([
                'account_id' => $account->id,
                'amount' => $amount,
                'type' => TransactionType::DebitTransfer,
            ]),
            'transferred_at' => fake()->dateTime(),
        ];
    }
}
