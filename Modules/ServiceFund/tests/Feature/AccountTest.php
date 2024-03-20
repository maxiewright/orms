<?php

use Filament\Actions\DeleteAction;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Bank;
use Modules\ServiceFund\App\Models\BankBranch;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\Database\Seeders\TransactionCategorySeeder;
use Modules\ServiceFund\Filament\App\Resources\AccountResource;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\CreateAccount;
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
    $this->bankBranch = BankBranch::factory()->create()->first();
    $this->minimumSignatories = fake()->numberBetween(1, 4);
    $this->maximumSignatories = fake()->numberBetween($this->minimumSignatories, $this->minimumSignatories + 2);
    $this->signatories = signatories();
});

it('shows the account index page', function () {
    // Arrange, Act and Assert
    get(AccountResource::getUrl())
        ->assertSuccessful();
});

it('shows a list of accounts', function () {
    // Arrange
    $accounts = Account::factory()->count(5)->create();
    // Act and Assert
    livewire(AccountResource\Pages\ListAccounts::class)
        ->assertCanSeeTableRecords($accounts);
});

it('creates an account', function () {

    // Act and Assert
    livewire(AccountResource\Pages\CreateAccount::class)
        ->fillForm(getFormFields())
        ->call('create')
        ->assertHasNoFormErrors();

    $account = Account::first();

    assertDatabaseHas(Account::class, createdAccount($account));
});

it('validate the user input', function () {
    livewire(AccountResource\Pages\CreateAccount::class)
        ->fillForm([
            'company_id' => null,
            'type' => null,
            'name' => null,
            'number' => null,
            'bank_branch_id' => null,
            'opening_balance_in_cents' => 'some big figure',
            'signatories' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'company_id' => 'required',
            'type' => 'required',
            'name' => 'required',
            'number' => 'required',
            'bank_branch_id' => 'required',
            'opening_balance_in_cents' => 'numeric',
            'signatories' => 'required',
        ]);
});

it('shows the edit view', function () {
    // Arrange
    get(AccountResource::getUrl('edit', [
        'record' => Account::factory()->create(),
    ]))->assertSuccessful();
});

it('shows the data in the edit form', function () {
    // Arrange
    $account = Account::factory()->create();

    // Act and Assert
    livewire(AccountResource\Pages\EditAccount::class, [
        'record' => $account->getRouteKey(),
    ])
        ->assertFormSet([
            'name' => $account->name,
            'type' => $account->type->value,
            'number' => $account->number,
            'bank_branch_id' => $account->bankBranch->id,
            'opening_balance_in_cents' => $account->opening_balance_in_cents,
        ]);
});

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

it('calculates the correct balance', function () {
    // Arrange
    $account = Account::factory()->create(['opening_balance_in_cents' => 10000]);

    Transaction::factory()->debit()->for($account)->create(['amount_in_cents' => 1000]);
    Transaction::factory()->credit()->for($account)->create(['amount_in_cents' => 500]);
    Transaction::factory()->debitTransfer()->for($account)->create(['amount_in_cents' => 1000]);
    Transaction::factory()->creditTransfer()->for($account)->create(['amount_in_cents' => 500]);

    // Act and Assert
    expect($account->balance)->toBe(110);
});

it('ensures that the amount of signatories selected is not below the minimum', function () {
    //TODO: Fix this test and the component to ensure that amount signatories selected is not less than the minimum
    //Arrange
    $this->minimumSignatories = 2;
    $this->maximumSignatories = 4;
    $this->signatories = signatories(2);

    // Act and Assert
    livewire(CreateAccount::class)
        ->fillForm(getFormFields())
        ->call('create')
        ->assertHasNoFormErrors();

    $account = Account::first();

    expect($account->signatories()->count())->toBe(2);

})->todo();

todo('test that only the min and max amount signatories can be selected');
todo('it shows a list of signatories');
todo('cannot be delete by unauthorized user');
