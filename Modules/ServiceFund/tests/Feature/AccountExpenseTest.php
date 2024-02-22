<?php

use Modules\ServiceFund\Database\Seeders\TransactionCategorySeeder;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountCredit;
use Tests\TestCase;

use function Pest\Laravel\get;
use function Pest\Laravel\seed;

uses(TestCase::class);

beforeEach(function () {
    logInAsUserWithRole();

    filament()->setCurrentPanel(
        filament()->getPanel('service-fund')
    );

    seed([TransactionCategorySeeder::class]);

});

it('shows the credit create form', function () {
    // Arrange, Act and Assert
    get(AccountCredit::getUrl('create'))
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
            'bank_id' => null,
            'opening_balance' => 'some big figure',
            'signatories' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'company_id' => 'required',
            'type' => 'required',
            'name' => 'required',
            'number' => 'required',
            'bank_id' => 'required',
            'opening_balance' => 'numeric',
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
            'bank_id' => $account->bank->id,
            'opening_balance' => $account->opening_balance,
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
