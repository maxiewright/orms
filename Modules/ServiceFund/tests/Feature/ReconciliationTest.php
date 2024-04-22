<?php

use Filament\Actions\DeleteAction;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Reconciliation;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\Database\Seeders\TransactionCategorySeeder;
use Modules\ServiceFund\Filament\App\Resources\ReconciliationResource;
use Modules\ServiceFund\Filament\App\Resources\ReconcilitationResource\Pages\CreateReconciliation;
use Modules\ServiceFund\Filament\App\Resources\ReconcilitationResource\Pages\ListReconciliations;
use Modules\ServiceFund\Filament\App\Resources\TransactionResource;
use Modules\ServiceFund\Filament\App\Resources\TransactionResource\Pages\EditTransaction;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;

uses(\Tests\TestCase::class);

include 'Helper.php';

beforeEach(function () {
    logInAsUserWithRole();

    filament()->setCurrentPanel(
        filament()->getPanel('service-fund')
    );

    seed([
        TransactionCategorySeeder::class,
    ]);
});

it('shows the reconciliation index page', function () {
    get(ReconciliationResource::getUrl())
        ->assertSuccessful();
});

it('shows a list of reconciliations', function () {

    $reconciliations = Reconciliation::factory()
        ->has(Transaction::factory()->count(3))
        ->count(5)
        ->create();

    livewire(ListReconciliations::class)
        ->assertCanSeeTableRecords($reconciliations);
});

it('creates an reconciliation', function () {

    $account = Account::factory()->create();

    livewire(CreateReconciliation::class)
        ->fillForm([
            'account_id' => $account->id,
            'started_at' => now()->subMonth()->startOfMonth(),
            'ended_at' => now()->subMonth()->endOfMonth(),
            'closing_balance_in_cents' => 200000,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas('reconciliations', [
        'account_id' => $account->id,
        'started_at' => now()->subMonth()->startOfMonth(),
        'ended_at' => now()->subMonth()->endOfMonth(),
        'closing_balance_in_cents' => 2000,
    ]);
});


//it('shows the edit view', function () {
//    // Arrange
//    get(TransactionResource::getUrl('edit', [
//        'record' => Transaction::factory()->create(),
//    ]))->assertSuccessful();
//});
//
//it('shows the data in the edit form', function () {
//    // Arrange
//    $reconciliation = Transaction::factory()->create();
//    // Act and Assert
//    livewire(EditTransaction::class, [
//        'record' => $reconciliation->getRouteKey(),
//    ])
//        ->assertFormSet(createdTransaction($reconciliation));
//});
//
//it('can be soft deleted', function () {
//    // Arrange
//    $reconciliation = Transaction::factory()->create();
//
//    // Act and Assert
//    livewire(EditTransaction::class, [
//        'record' => $reconciliation->getRouteKey(),
//    ])
//        ->callAction(DeleteAction::class);
//
//    assertSoftDeleted($reconciliation);
//});
