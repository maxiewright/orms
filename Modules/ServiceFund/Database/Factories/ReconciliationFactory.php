<?php

namespace Modules\ServiceFund\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Reconciliation;
use Modules\ServiceFund\App\Models\Transaction;

class ReconciliationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Reconciliation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'account_id' => Account::factory(),
            'started_at' => now()->subMonth()->startOfMonth(),
            'ended_at' => now()->subMonth()->endOfMonth(),
            'closing_balance_in_cents' => fake()->numberBetween(1000, 100000),
        ];
    }

//    public function configure(): static
//    {
//        return $this->afterMaking(function (Reconciliation $reconciliation) {
//            $reconciliation
//                ->transactions()
//                ->createMany(Transaction::factory()->reconciled($reconciliation->id)->count(3)->make([
//                    'reconciliation_id' => $reconciliation->id,
//                ]));
//        })->afterCreating(function (Reconciliation $reconciliation) {
//            $reconciliation
//                ->transactions()
//                ->saveMany(Transaction::factory()->count(10)->make());
//        });
//    }
}
