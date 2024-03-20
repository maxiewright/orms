<?php

use Modules\ServiceFund\App\Models\Contact;
use Modules\ServiceFund\App\Models\TransactionCategory;
use Modules\ServiceFund\Enums\AccountType;
use Modules\ServiceFund\Enums\PaymentMethod;
use Modules\ServiceFund\Enums\TransactionType;


/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
| This file is for helper functions that are used in multiple tests.
|
*/

function createdAccount($account): array
{
    return [
        'company_id' => $account->company->id,
        'type' => $account->type,
        'name' => \Illuminate\Support\Str::lower($account->name),
        'number' => $account->number,
        'bank_branch_id' => $account->bankBranch->id,
        'opening_balance_in_cents' => $account->opening_balance_in_cents,
        'minimum_signatories' => $account->minimum_signatories,
        'maximum_signatories' => $account->maximum_signatories,
        'active_at' => $account->active_at,
    ];
}

function getFormFields(): array
{
    return [
        'company_id' => test()->company->id,
        'type' => fake()->randomElement(AccountType::cases()),
        'name' => 'Some Account',
        'number' => fake()->randomNumber(6),
        'bank_branch_id' => test()->bankBranch->id,
        'opening_balance_in_cents' => fake()->randomNumber(6),
        'minimum_signatories' => test()->minimumSignatories,
        'maximum_signatories' => test()->maximumSignatories,
        'signatories' => test()->signatories,
    ];
}

function transactionFields(): array
{
    return debitAndCreditFields() + [
        'account_id' => test()->account->id,
        'type' => TransactionType::Debit,
        'created_by' => auth()->id(),
    ];
}

function debitAndCreditFields(): array
{
    $transactionalType = transactional();
    $transactionalId = ($transactionalType === 'App\Models\Serviceperson')
        ? app(config('servicefund.user.model'))::factory()->create()->number
        : Contact::factory()->create()->id;

    return [
        'payment_method' => fake()->randomElement(PaymentMethod::cases()),
        'type' => fake()->randomElement(TransactionType::cases()),
        'amount_in_cents' => fake()->numberBetween(100, 1000),
        'categories' => TransactionCategory::all()->random()->id,
        'transactional_type' => $transactionalType,
        'transactional_id' => $transactionalId,
        'approved_by' => app(config('servicefund.user.model'))::factory()->create()->number,
        'executed_at' => now(),
        'approved_at' => now(),
    ];
}

function transactional()
{
    return fake()->randomElement([
        app(config('servicefund.user.model'))::class,
        Contact::class,
    ]);
}

function signatories(int $count = 1)
{
    return app(config('servicefund.user.model'))::factory()
        ->count($count)
        ->create();
}

function createdTransaction($transaction): array
{
    return [
        'account_id' => $transaction->account_id,
        'type' => $transaction->type->value,
        'executed_at' => $transaction->executed_at?->format('Y-m-d H:i'),
        'amount_in_cents' => $transaction->amount_in_cents,
        'payment_method' => $transaction->payment_method->value,
        'approved_by' => $transaction->approved_by,
        'approved_at' => $transaction->approved_at?->format('Y-m-d H:i'),
    ];
}
