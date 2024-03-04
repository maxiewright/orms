<?php

use Filament\Actions\DeleteAction;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Bank;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\Database\Seeders\TransactionCategorySeeder;
use Modules\ServiceFund\Enums\AccountType;
use Modules\ServiceFund\Filament\App\Resources\AccountResource;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\CreateAccount;
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

it('ensures that the amount of signatories selected is not below the minimum', function () {
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

it('has a balance', function () {
    // Arrange
    $account = Account::factory()->create(['opening_balance' => 100]);

    Transaction::factory()->debit()->for($account)->create(['amount' => 10]);
    Transaction::factory()->credit()->for($account)->create(['amount' => 5]);
    Transaction::factory()->debitTransfer()->for($account)->create(['amount' => 10]);
    Transaction::factory()->creditTransfer()->for($account)->create(['amount' => 5]);
    //
    // Act and Assert
    expect($account->balance)->toBe(110);
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
