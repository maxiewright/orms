<?php

namespace Modules\ServiceFund\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Contact;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\App\Models\TransactionCategory;
use Modules\ServiceFund\Enums\PaymentMethodEnum;
use Modules\ServiceFund\Enums\TransactionTypeEnum;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\ServiceFund\App\Models\Transaction::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $executionDate = fake()->dateTimeBetween('-30 days');
        $transactional = $this->transactional();

        return [
            'account_id' => Account::factory(),
            'type' => fake()->randomElement(TransactionTypeEnum::cases()),
            'executed_at' => $executionDate,
            'amount' => fake()->randomFloat(2),
            'payment_method' => fake()->randomElement(PaymentMethodEnum::cases()),
            'transaction_category_id' => TransactionCategory::all()->random()->id,
            'transactional_id' => $transactional::factory(),
            'transactional_type' => $transactional,
            'description' => fake()->text(),
            'approved_by' => app(config('servicefund.user.model'))::factory(),
            'approved_at' => Carbon::make($executionDate)->subDay(),
            'created_by' => auth()->id(),
        ];
    }

    public function expense(): self
    {
        return $this->state(fn () => [
            'type' => TransactionTypeEnum::Expense,
        ]);
    }

    public function income(): self
    {
        return $this->state(fn () => [
            'type' => TransactionTypeEnum::Income,
        ]);
    }

    public function transfer(): self
    {
        return $this->state(fn () => [
            'type' => TransactionTypeEnum::Transfer,
        ]);
    }

    private function transactional()
    {
        return fake()->randomElement([
            app(config('servicefund.user.model'))::class,
            Contact::class,
        ]);
    }

    public function hasParent(): self
    {
        return $this->state(fn () => [
            'parent_id' => Transaction::factory(),
        ]);
    }
}
