<?php

use Filament\Actions\DeleteAction;
use Modules\ServiceFund\App\Actions\ProcessTransferAction;
use Modules\ServiceFund\App\Events\TransferCompleted;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Bank;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\App\Models\Transfer;
use Modules\ServiceFund\Database\Seeders\TransactionCategorySeeder;
use Modules\ServiceFund\Enums\PaymentMethod;
use Modules\ServiceFund\Enums\TransactionType;
use Modules\ServiceFund\Filament\App\Resources\AccountResource;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountCreditTransfer;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountDebitTransfer;
use Modules\ServiceFund\Filament\App\Resources\TransferResource;
use Modules\ServiceFund\Filament\App\Resources\TransferResource\Pages\CreateTransfer;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;

uses(TestCase::class);

include 'Helper.php';

beforeEach(function () {
    logInAsUserWithRole();

    filament()->setCurrentPanel(
        filament()->getPanel('service-fund')
    );

    seed([TransactionCategorySeeder::class]);

    $this->company = app(config('servicefund.company.model'))::all()->random();
    $this->bank = Bank::factory()->create()->first();

    $this->account = Account::factory()->create();
    $this->debitTransfers = Transaction::factory()->debitTransfer()->for($this->account)->count(5)->create();
    $this->creditTransfers = Transaction::factory()->creditTransfer()->for($this->account)->count(5)->create();

});

it('renders an account debit transfers page', function () {
    get(AccountDebitTransfer::getUrl(['record' => $this->account]))
        ->assertSuccessful();
});

it('lists only debit transfers account debit transfer page', function () {

    livewire(AccountDebitTransfer::class, [
        'record' => $this->account,
    ])
        ->assertCanSeeTableRecords($this->debitTransfers)
        ->assertCanNotSeeTableRecords($this->creditTransfers)
        ->assertCountTableRecords(5);
});

it('renders an account credit transfers page', function () {
    get(AccountCreditTransfer::getUrl(['record' => $this->account]))
        ->assertSuccessful();
});

it('lists only credit transfers on the account credit transfer page', function () {

    livewire(AccountCreditTransfer::class, [
        'record' => $this->account,
    ])
        ->assertCanSeeTableRecords($this->creditTransfers)
        ->assertCanNotSeeTableRecords($this->debitTransfers)
        ->assertCountTableRecords(5);
});

it('shows a transfer index page', function () {
    // Arrange, Act and Assert
    get(TransferResource::getUrl())
        ->assertSuccessful();
});

it('shows a list of all transfers', function () {
    // Arrange
    $transfers = Transfer::factory()->count(5)->create();
    // Act and Assert
    livewire(TransferResource\Pages\ListTransfers::class)
        ->assertCanSeeTableRecords($transfers);
});

it('creates an transfer', function () {

    // Act and Assert
    livewire(CreateTransfer::class)
        ->fillForm([

        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $account = Transfer::first();

    assertDatabaseHas(Transfer::class, []);

})->todo();

it('can be soft deleted', function () {
    // Arrange
    $account = Account::factory()->create();
    // Act and Assert
    livewire(AccountResource\Pages\EditAccount::class, [
        'record' => $account->getRouteKey(),
    ])
        ->callAction(DeleteAction::class);

    assertSoftDeleted($account);
});

it('can process a transfer', function () {
    Event::fake();

    $creditAccount = Account::factory()->create([
        'opening_balance_in_cents' => 100000,
    ]);
    $debitAccount = Account::factory()->create([
        'opening_balance_in_cents' => 50000,
    ]);

    // Act and Assert
    $processTransfer = new ProcessTransferAction();

    $transfer = $processTransfer([
        'credit_account_id' => $creditAccount->id,
        'debit_account_id' => $debitAccount->id,
        'executed_at' => '2024-01-01',
        'amount_in_cents' => 50000,
        'payment_method' => fake()->randomElement(PaymentMethod::cases()),
        'transactional_type' => transactional(),
        'transactional_id' => transactional()::factory()->create(),
        'created_by' => auth()->id(),
    ]);

    Event::assertDispatched(TransferCompleted::class);

    assertDatabaseHas('transactions', [
        'account_id' => $creditAccount->id,
        'type' => TransactionType::CreditTransfer,
        'executed_at' => '2024-01-01 00:00:00',
        'amount_in_cents' => 50000,
    ]);

    assertDatabaseHas('transactions', [
        'account_id' => $debitAccount->id,
        'type' => TransactionType::DebitTransfer,
        'executed_at' => '2024-01-01 00:00:00',
        'amount_in_cents' => 50000,
    ]);

    assertDatabaseHas('transfers', [
        'debit_transaction_id' => $transfer->debitTransaction->id,
        'credit_transaction_id' => $transfer->creditTransaction->id,
        'transferred_at' => '2024-01-01 00:00:00',
    ]);

    expect($creditAccount->balance)->toBe(500)
        ->and($debitAccount->balance)->toBe(1000);

});
