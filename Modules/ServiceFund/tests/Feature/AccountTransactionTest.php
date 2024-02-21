<?php

use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\Database\Seeders\TransactionCategorySeeder;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountDashboard;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountExpense;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountIncome;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages\AccountTransfer;
use Tests\TestCase;

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
    $this->expenses = Transaction::factory()->expense()->for($this->account)->count(5)->create();
    $this->income = Transaction::factory()->income()->for($this->account)->count(5)->create();
    $this->transfers = Transaction::factory()->transfer()->for($this->account)->count(5)->create();
});

it('shows the account transactions dashboard', function () {
    get(AccountDashboard::getUrl(['record' => $this->account]))
        ->assertSuccessful();
});

it('renders the transactions expense page', function () {
    get(AccountExpense::getUrl(['record' => $this->account]))
        ->assertSuccessful();
});

it('lists only expenses transaction on the expense page', function () {
    livewire(AccountExpense::class, [
        'record' => $this->account,
    ])
        ->assertCanSeeTableRecords($this->expenses)
        ->assertCanNotSeeTableRecords($this->income)
        ->assertCanNotSeeTableRecords($this->transfers)
        ->assertCountTableRecords(5);
});

it('renders the transactions income page', function () {
    get(AccountIncome::getUrl(['record' => $this->account]))
        ->assertSuccessful();
});

it('lists only income transaction on the income page', function () {
    livewire(AccountIncome::class, [
        'record' => $this->account,
    ])
        ->assertCanSeeTableRecords($this->income)
        ->assertCanNotSeeTableRecords($this->expenses)
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
        ->assertCanNotSeeTableRecords($this->income)
        ->assertCanNotSeeTableRecords($this->expenses)
        ->assertCountTableRecords(5);
});

it('can add an expense transaction to an account', function () {
    // Arrange

    // Act and Assert

})->todo();

it('can add an income transaction to an account', function () {
    // Arrange

    // Act and Assert

});

it('can perform a transfer transaction between accounts', function () {
    // Arrange

    // Act and Assert

})->todo();
