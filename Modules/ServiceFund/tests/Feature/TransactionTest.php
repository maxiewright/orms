<?php

use Filament\Actions\DeleteAction;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Contact;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\App\Models\TransactionCategory;
use Modules\ServiceFund\Database\Seeders\TransactionCategorySeeder;
use Modules\ServiceFund\Enums\PaymentMethodEnum;
use Modules\ServiceFund\Enums\TransactionTypeEnum;
use Modules\ServiceFund\Filament\App\Resources\TransactionResource;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;

uses(\Tests\TestCase::class);

beforeEach(function () {
    logInAsUserWithRole();

    filament()->setCurrentPanel(
        filament()->getPanel('service-fund')
    );

    seed([
        TransactionCategorySeeder::class,
    ]);
});

it('shows the account index page', function () {
    // Arrange, Act and Assert
    get(TransactionResource::getUrl())
        ->assertSuccessful();
});

it('shows a list of transactions', function () {
    // Arrange
    $transactions = Transaction::factory()->count(5)->create();
    // Act and Assert
    livewire(TransactionResource\Pages\ListTransactions::class)
        ->assertCanSeeTableRecords($transactions);
});

it('creates an transaction', function () {
    // Arrange
    $account = Account::factory()->create();
    $category = TransactionCategory::all()->random();

    // Act and Assert
    livewire(TransactionResource\Pages\CreateTransaction::class)
        ->fillForm([
            'account_id' => $account->id,
            'type' => fake()->randomElement(TransactionTypeEnum::cases()),
            'executed_at' => now(),
            'amount' => fake()->randomFloat(),
            'payment_method' => fake()->randomElement(PaymentMethodEnum::cases()),
            'transaction_category_id' => $category->id,
            'transactional_id' => transactional()::factory()->create(),
            'transactional_type' => transactional(),
            'description' => null,
            'approved_by' => app(config('servicefund.user.model'))::factory()->create(),
            'approved_at' => fake()->dateTimeBetween('-2 days'),
            'created_by' => auth()->id(),
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $transaction = Transaction::first();

    assertDatabaseHas(Transaction::class, createdTransaction($transaction));
})->todo();

it('validate the user input', function () {
    livewire(TransactionResource\Pages\CreateTransaction::class)
        ->fillForm([
            'account_id' => null,
            'type' => null,
            'executed_at' => 'some date',
            'amount' => 'some big figure',
            'payment_method' => null,
            'transaction_category_id' => null,
            'approved_by' => null,
            'approved_at' => 'an approval date',
        ])
        ->call('create')
        ->assertHasFormErrors([
            'account_id' => 'required',
            'type' => 'required',
            'executed_at' => 'date',
            'amount' => 'numeric',
            'payment_method' => 'required',
            'transaction_category_id' => 'required',
            'approved_by' => 'required',
            'approved_at' => 'date',
        ]);
});

it('shows the edit view', function () {
    // Arrange
    get(TransactionResource::getUrl('edit', [
        'record' => Transaction::factory()->create(),
    ]))->assertSuccessful();
});

it('shows the data in the edit form', function () {
    // Arrange
    $transaction = Transaction::factory()->create();
    // Act and Assert
    livewire(TransactionResource\Pages\EditTransaction::class, [
        'record' => $transaction->getRouteKey(),
    ])
        ->assertFormSet(createdTransaction($transaction));
});

it('can be soft deleted', function () {
    // Arrange
    $transaction = Transaction::factory()->create();

    // Act and Assert
    livewire(TransactionResource\Pages\EditTransaction::class, [
        'record' => $transaction->getRouteKey(),
    ])
        ->callAction(DeleteAction::class);

    assertSoftDeleted($transaction);
});

function createdTransaction($transaction): array
{
    return [
        'account_id' => $transaction->account_id,
        'type' => $transaction->type->value,
        'executed_at' => $transaction->executed_at->format('Y-m-d H:i'),
        'amount' => $transaction->amount,
        'payment_method' => $transaction->payment_method->value,
        'transaction_category_id' => $transaction->transaction_category_id,
        'approved_by' => $transaction->approved_by,
        'approved_at' => $transaction->approved_at->format('Y-m-d H:i'),
    ];
}

function transactional()
{
    return fake()->randomElement([
        app(config('servicefund.user.model'))::class,
        Contact::class,
    ]);
}
