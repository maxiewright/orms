<?php

use Filament\Actions\DeleteAction;
use Modules\ServiceFund\App\Actions\ProcessTransferAction;
use Modules\ServiceFund\App\Events\TransferCompleted;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Bank;
use Modules\ServiceFund\App\Models\Transfer;
use Modules\ServiceFund\Database\Seeders\TransactionCategorySeeder;
use Modules\ServiceFund\Enums\AccountType;
use Modules\ServiceFund\Enums\PaymentMethod;
use Modules\ServiceFund\Enums\TransactionType;
use Modules\ServiceFund\Filament\App\Resources\AccountResource;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\CreateAccount;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\ListAccounts;
use Modules\ServiceFund\Filament\App\Resources\TransferResource;
use Modules\ServiceFund\Filament\App\Resources\TransferResource\Pages\CreateTransfer;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;

uses(TestCase::class);

beforeEach(function () {
    logInAsUserWithRole();

    filament()->setCurrentPanel(
        filament()->getPanel('service-fund')
    );

    seed([TransactionCategorySeeder::class]);

    $this->company = app(config('servicefund.company.model'))::all()->random();
    $this->bank = Bank::factory()->create()->first();

});

it('can process a transfer', function () {
    Event::fake();

    $creditAccount = Account::factory()->create([
        'opening_balance' => 1000,
    ]);
    $debitAccount = Account::factory()->create([
        'opening_balance' => 500,
    ]);

    // Act and Assert
    $processTransfer = new ProcessTransferAction();

    $transfer = $processTransfer([
        'credit_account_id' => $creditAccount->id,
        'debit_account_id' => $debitAccount->id,
        'executed_at' => '2024-01-01',
        'amount' => 500,
        'payment_method' => fake()->randomElement(PaymentMethod::cases()),
        'particulars' => 'some particulars',
        'transactional_type' => 'some type',
        'transactional_id' => 1,
        'created_by' => auth()->id(),
    ]);

    Event::assertDispatched(TransferCompleted::class);

    assertDatabaseHas('transactions', [
        'account_id' => $creditAccount->id,
        'type' => TransactionType::CreditTransfer,
        'executed_at' => '2024-01-01 00:00:00',
        'amount' => 500,
    ]);

    assertDatabaseHas('transactions', [
        'account_id' => $debitAccount->id,
        'type' => TransactionType::DebitTransfer,
        'executed_at' => '2024-01-01 00:00:00',
        'amount' => 500,
    ]);

    assertDatabaseHas('transfers', [
        'credit_transaction_id' => $creditAccount->id,
        'debit_transaction_id' => $debitAccount->id,
        'transferred_at' => '2024-01-01 00:00:00',
    ]);

    expect($creditAccount->balance)->toBe(500.00)
        ->and($debitAccount->balance)->toBe(1000.00);

});



todo('test that only the min and max amount signatories can be selected');

todo('it shows a list of signatories');

todo('cannot be delete by unauthorized user');

function createdAccount($account): array
{
    return [
        'company_id' => $account->company->id,
        'type' => $account->type,
        'name' => \Illuminate\Support\Str::lower($account->name),
        'number' => $account->number,
        'bank_id' => $account->bank->id,
        'opening_balance' => $account->opening_balance,
        'minimum_signatories' => $account->minimum_signatories,
        'maximum_signatories' => $account->maximum_signatories,
        'active_at' => $account->active_at,
    ];
}

/**
 * @param  TestCase|\PHPUnit\Framework\TestCase  $this
 */
function getFormFields(): array
{
    return [
        'company_id' => test()->company->id,
        'type' => fake()->randomElement(AccountType::cases()),
        'name' => 'Some Account',
        'number' => fake()->randomNumber(6),
        'bank_id' => test()->bank->id,
        'opening_balance' => fake()->randomNumber(6),
        'minimum_signatories' => test()->minimumSignatories,
        'maximum_signatories' => test()->maximumSignatories,
        'signatories' => test()->signatories,
    ];
}

function signatories(int $count = 1)
{
    return app(config('servicefund.user.model'))::factory()
        ->count($count)
        ->create();
}
