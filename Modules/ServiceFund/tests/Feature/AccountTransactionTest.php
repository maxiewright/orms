<?php

use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Contact;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\App\Models\TransactionCategory;
use Modules\ServiceFund\Database\Seeders\TransactionCategorySeeder;
use Modules\ServiceFund\Enums\PaymentMethodEnum;
use Modules\ServiceFund\Enums\TransactionTypeEnum;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountCredit;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountDashboard;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountDebit;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountTransfer;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;
use function Pest\Laravel\withoutExceptionHandling;
use function Pest\Livewire\livewire;

uses(TestCase::class);

beforeEach(function () {
    logInAsUserWithRole();

    filament()->setCurrentPanel(
        filament()->getPanel('service-fund')
    );

    seed([TransactionCategorySeeder::class]);

    $this->account = Account::factory()->create();
    $this->credits = Transaction::factory()->expense()->for($this->account)->count(5)->create();
    $this->debit = Transaction::factory()->debit()->for($this->account)->count(5)->create();
    $this->transfers = Transaction::factory()->transfer()->for($this->account)->count(5)->create();
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
        ->assertCanNotSeeTableRecords($this->transfers)
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
        ->assertCanNotSeeTableRecords($this->transfers)
        ->assertCountTableRecords(5);
});

it('renders the transactions transfers page', function () {
    get(AccountTransfer::getUrl(['record' => $this->account]))
        ->assertSuccessful();
});

it('lists only transfers transaction on the transfer page', function () {
    livewire(AccountTransfer::class, [
        'record' => $this->account,
    ])
        ->assertCanSeeTableRecords($this->transfers)
        ->assertCanNotSeeTableRecords($this->debit)
        ->assertCanNotSeeTableRecords($this->credits)
        ->assertCountTableRecords(5);
});

it('can add a debit transaction', function () {

    livewire(AccountDebit::class, ['record' => $this->account])
        ->callAction(name: 'create', data: debitAndCreditTransactionFields())
        ->assertHasNoActionErrors();

    $transaction = Transaction::first();

    assertDatabaseHas('transactions', [
        'account_id' => $this->account->id,
        'type' => TransactionTypeEnum::Debit,
    ]);

})->todo();

it('can add a credit transaction', function () {
    // Arrange

    // Act and Assert

})->todo();

it('can perform a transfer transaction', function () {
    // Arrange

    // Act and Assert

})->todo();

function debitAndCreditTransactionFields(): array
{
    return [
        'payment_method' => fake()->randomElement(PaymentMethodEnum::cases()),
        'amount' => fake()->randomFloat(),
        'transaction_category_id' => TransactionCategory::all()->random()->id,
        'transactional_id' => transactional()::factory()->create(),
        'transactional_type' => transactional(),
        'approved_by' => auth()->id(),
    ];
}

function transactional()
{
    return fake()->randomElement([
        app(config('servicefund.user.model'))::class,
        Contact::class,
    ]);
}
