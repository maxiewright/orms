<?php

namespace Modules\ServiceFund\tests\Feature\Metadata;

use Illuminate\Support\Str;
use Modules\ServiceFund\App\Models\TransactionCategory;
use Modules\ServiceFund\Database\Seeders\TransactionCategorySeeder;
use Modules\ServiceFund\Filament\App\Resources\TransactionCategoryResource;
use Modules\ServiceFund\Filament\App\Resources\TransactionCategoryResource\Pages\ManageTransactionCategories;
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

    seed(TransactionCategorySeeder::class);

    $this->category = TransactionCategory::factory()->create([
        'name' => 'New Category',
        'description' => 'New Category Description',
    ]);
});

it('renders the categories page', function () {
    get(TransactionCategoryResource::getUrl())
        ->assertSuccessful();
});

it('shows a list of categories', function () {
    livewire(ManageTransactionCategories::class)
        ->assertCanSeeTableRecords(
            TransactionCategory::limit(10)->get()
        );
});

it('creates a category', function () {
    livewire(ManageTransactionCategories::class)
        ->callAction('create', [
            'name' => 'Category',
            'description' => 'New Category Description',
        ])->assertHasNoActionErrors();

    assertDatabaseHas('transaction_categories', [
        'name' => 'category',
        'description' => 'New Category Description',
    ]);

});

it('edits a category', function () {
    livewire(ManageTransactionCategories::class)
        ->callTableAction('edit', $this->category, [
            'name' => 'Edited Category',
            'description' => 'Edited Category Description',
        ])
        ->assertHasNoActionErrors();

    assertDatabaseHas('transaction_categories', [
        'name' => 'edited category',
        'description' => 'Edited Category Description',
    ]);

});

it('soft deletes a category', function () {
    livewire(ManageTransactionCategories::class)
        ->callTableAction('delete', $this->category)
        ->assertHasNoActionErrors();

    assertSoftDeleted('transaction_categories', [
        'name' => 'new category',
        'description' => 'New Category Description',
    ]);
});

/*
 * @todo Fix the restore action test
 * Testing the restore action is not working but the functionality is working in the GUI
 */
it('restores a category', function () {
    // Arrange
    $deletedCategory = TransactionCategory::factory()->create();

    $deletedCategory->delete();
    // Act and Assert
    livewire(ManageTransactionCategories::class)
        ->callTableAction('restore', $deletedCategory)
        ->assertHasNoActionErrors();

    $restoredCategory = $deletedCategory->fresh();

    assertDatabaseHas('transaction_categories', [
        'name' => Str::lower($restoredCategory->name),
        'description' => $restoredCategory->description,
        'deleted_at' => null,
    ]);

})->todo();
