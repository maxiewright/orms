<?php

use Modules\ServiceFund\App\Actions\ProcessTransactionAction;
use Modules\ServiceFund\App\Events\TransactionCreated;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\Database\Seeders\TransactionCategorySeeder;
use Modules\ServiceFund\Enums\TransactionType;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountCreditTransaction;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountDashboard;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountDebitTransaction;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseHas;
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

    $this->account = Account::factory()->create();
    $this->credits = Transaction::factory()->credit()->for($this->account)->count(5)->create();
    $this->debit = Transaction::factory()->debit()->for($this->account)->count(5)->create();
});

it('shows the account transactions dashboard', function () {
    get(AccountDashboard::getUrl(['record' => $this->account]))
        ->assertSuccessful();
});

it('renders the transactions debit page', function () {
    get(AccountDebitTransaction::getUrl(['record' => $this->account]))
        ->assertSuccessful();
});

it('lists only debits transaction on the debit page', function () {
    livewire(AccountDebitTransaction::class, [
        'record' => $this->account,
    ])
        ->assertCanSeeTableRecords($this->debit)
        ->assertCanNotSeeTableRecords($this->credits)
        ->assertCountTableRecords(5);
});

it('renders the transactions credit page', function () {
    get(AccountCreditTransaction::getUrl(['record' => $this->account]))
        ->assertSuccessful();
});

it('lists only credits transaction on the credit page', function () {

    livewire(AccountCreditTransaction::class, [
        'record' => $this->account,
    ])
        ->assertCanSeeTableRecords($this->credits)
        ->assertCanNotSeeTableRecords($this->debit)
        ->assertCountTableRecords(5);
});

it('can process a transaction and dispatch its creation event', function () {
    // Arrange
    Event::fake();

    // Act and Assert
    $processTransaction = new ProcessTransactionAction();

    $newTransaction = Transaction::factory()->create([
        'account_id' => $this->account->id,
        'type' => TransactionType::Debit,
    ]);

    $transaction = $processTransaction($newTransaction->toArray() + ['categories' => [1, 2]]);

    Event::assertDispatched(TransactionCreated::class);

    assertDatabaseHas('transactions', [
        'account_id' => $this->account->id,
        'type' => $transaction->type,
        'amount_in_cents' => $transaction->amount_in_cents,
    ]);
});

it('has the add debit label', function () {
    livewire(AccountDebitTransaction::class, [
        'record' => $this->account,
    ])
        ->assertActionHasLabel('create', 'New Debit')
        ->assertActionDoesNotHaveLabel('create', 'Create')
        ->assertActionDoesNotHaveLabel('create', 'New Credit')
        ->assertActionDoesNotHaveLabel('create', 'Add Transfer');
});

it('can add a debit transaction', function () {
    Event::fake();

    livewire(AccountDebitTransaction::class, [
        'record' => $this->account,
    ])
        ->callAction(name: 'create', data: debitAndCreditFields())
        ->assertHasNoActionErrors();

    Event::assertDispatched(TransactionCreated::class);

    $transaction = Transaction::latest()->first();

    assertDatabaseHas('transactions', [
        'account_id' => $this->account->id,
        'type' => TransactionType::Debit,
        'amount_in_cents' => $transaction->amount_in_cents,
    ]);

});

it('has the add credit label', function () {
    livewire(AccountCreditTransaction::class, [
        'record' => $this->account,
    ])
        ->assertActionHasLabel('create', 'New Credit')
        ->assertActionDoesNotHaveLabel('create', 'Create')
        ->assertActionDoesNotHaveLabel('create', 'New Debit')
        ->assertActionDoesNotHaveLabel('create', 'Add Transfer');
});

it('can add a credit transaction', function () {
    Event::fake();

    livewire(AccountCreditTransaction::class, [
        'record' => $this->account,
    ])
        ->callAction(name: 'create', data: debitAndCreditFields())
        ->assertHasNoActionErrors();

    Event::assertDispatched(TransactionCreated::class);

    $transaction = Transaction::latest()->first();

    assertDatabaseHas('transactions', [
        'account_id' => $this->account->id,
        'type' => TransactionType::Credit,
        'amount_in_cents' => $transaction->amount_in_cents,
    ]);

});
