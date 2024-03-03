<?php

use Modules\ServiceFund\App\Actions\ProcessTransactionAction;
use Modules\ServiceFund\App\Events\TransactionCreated;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Contact;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\App\Models\TransactionCategory;
use Modules\ServiceFund\Database\Seeders\TransactionCategorySeeder;
use Modules\ServiceFund\Enums\PaymentMethod;
use Modules\ServiceFund\Enums\TransactionType;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountCredit;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountCreditTransfer;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountDashboard;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountDebit;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountDebitTransfer;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseHas;
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

    $this->account = Account::factory()->create();
    $this->credits = Transaction::factory()->credit()->for($this->account)->count(5)->create();
    $this->debit = Transaction::factory()->debit()->for($this->account)->count(5)->create();
    $this->debitTransfers = Transaction::factory()->debitTransfer()->for($this->account)->count(5)->create();
    $this->creditTransfers = Transaction::factory()->creditTransfer()->for($this->account)->count(5)->create();
});

it('shows the account transactions dashboard', function () {
    get(AccountDashboard::getUrl(['record' => $this->account]))
        ->assertSuccessful();
});

it('renders the transactions debit page', function () {
    get(AccountDebit::getUrl(['record' => $this->account]))
        ->assertSuccessful();
});

it('lists only debits transaction on the debit page', function () {
    livewire(AccountDebit::class, [
        'record' => $this->account,
    ])
        ->assertCanSeeTableRecords($this->debit)
        ->assertCanNotSeeTableRecords($this->credits)
        ->assertCanNotSeeTableRecords($this->debitTransfers)
        ->assertCanNotSeeTableRecords($this->creditTransfers)
        ->assertCountTableRecords(5);
});

it('renders the transactions credit page', function () {
    get(AccountCredit::getUrl(['record' => $this->account]))
        ->assertSuccessful();
});

it('lists only credits transaction on the credit page', function () {
    livewire(AccountCredit::class, [
        'record' => $this->account,
    ])
        ->assertCanSeeTableRecords($this->credits)
        ->assertCanNotSeeTableRecords($this->debit)
        ->assertCanNotSeeTableRecords($this->debitTransfers)
        ->assertCanNotSeeTableRecords($this->creditTransfers)
        ->assertCountTableRecords(5);
});

it('renders the transactions transfers page', function () {
    get(AccountDebitTransfer::getUrl(['record' => $this->account]))
        ->assertSuccessful();
});

it('lists only debit transfers transaction on the debit transfer page', function () {
    livewire(AccountDebitTransfer::class, [
        'record' => $this->account,
    ])
        ->assertCanSeeTableRecords($this->debitTransfers)
        ->assertCanNotSeeTableRecords($this->creditTransfers)
        ->assertCanNotSeeTableRecords($this->debit)
        ->assertCanNotSeeTableRecords($this->credits)
        ->assertCountTableRecords(5);
});

it('lists only credit transfers transaction on the credit transfer page', function () {
    livewire(AccountCreditTransfer::class, [
        'record' => $this->account,
    ])
        ->assertCanSeeTableRecords($this->creditTransfers)
        ->assertCanNotSeeTableRecords($this->debitTransfers)
        ->assertCanNotSeeTableRecords($this->debit)
        ->assertCanNotSeeTableRecords($this->credits)
        ->assertCountTableRecords(5);
});

it('can process a transaction and dispatch its creation event', function () {
    // Arrange
    Event::fake();

    // Act and Assert
    $processTransaction = new ProcessTransactionAction();

    $transaction = $processTransaction(transactionFields());

    Event::assertDispatched(TransactionCreated::class);

    assertDatabaseHas('transactions', [
        'account_id' => $this->account->id,
        'type' => $transaction->type,
        'amount' => $transaction->amount,
    ]);
});

it('has the add debit label', function () {
    livewire(AccountDebit::class, [
        'record' => $this->account,
    ])
        ->assertActionHasLabel('create', 'New Debit')
        ->assertActionDoesNotHaveLabel('create', 'Create')
        ->assertActionDoesNotHaveLabel('create', 'New Credit')
        ->assertActionDoesNotHaveLabel('create', 'Add Transfer');
});

it('can add a debit transaction', function () {
    Event::fake();

    livewire(AccountDebit::class, [
        'record' => $this->account,
    ])
        ->callAction(name: 'create', data: debitAndCreditFields())
        ->assertHasNoActionErrors();

    Event::assertDispatched(TransactionCreated::class);

    $transaction = Transaction::latest()->first();

    assertDatabaseHas('transactions', [
        'account_id' => $this->account->id,
        'type' => TransactionType::Debit,
        'amount' => $transaction->amount,
    ]);

});

it('has the add credit label', function () {
    livewire(AccountCredit::class, [
        'record' => $this->account,
    ])
        ->assertActionHasLabel('create', 'New Credit')
        ->assertActionDoesNotHaveLabel('create', 'Create')
        ->assertActionDoesNotHaveLabel('create', 'New Debit')
        ->assertActionDoesNotHaveLabel('create', 'Add Transfer');
});

it('can add a credit transaction', function () {
    Event::fake();

    livewire(AccountCredit::class, [
        'record' => $this->account,
    ])
        ->callAction(name: 'create', data: debitAndCreditFields())
        ->assertHasNoActionErrors();

    Event::assertDispatched(TransactionCreated::class);

    $transaction = Transaction::latest()->first();

    assertDatabaseHas('transactions', [
        'account_id' => $this->account->id,
        'type' => TransactionType::Credit,
        'amount' => $transaction->amount,
    ]);

});

it('can perform a transfer transaction', function () {
    // Arrange

    // Act and Assert

})->todo();

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
        'amount' => fake()->randomFloat(),
        'transaction_category_id' => TransactionCategory::all()->random()->id,
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
