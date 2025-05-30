<?php

use Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexGroupResource;
use Modules\Registry\Models\RegistryIndex\IndexGroup;
use Modules\Registry\Tests\TestCase\RegistryTestCase;

use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

uses(RegistryTestCase::class);

// Skip authentication for now
// beforeEach(function () {
//     // Login as admin user
//     logInAsUserWithRole();
// });

it('can render index page', function (): void {
    get(IndexGroupResource::getUrl('index'))
        ->assertSuccessful();
});

it('can list index groups', function (): void {
    // Create some index groups
    $groups = IndexGroup::factory()->count(5)->create();

    // Test the Livewire component
    livewire(IndexGroupResource\Pages\ListIndexGroups::class)
        ->assertCanSeeTableRecords($groups);
});

it('can create an index group', function (): void {
    $newGroup = [
        'name' => 'Test Group',
    ];

    livewire(IndexGroupResource\Pages\CreateIndexGroup::class)
        ->fillForm($newGroup)
        ->call('create')
        ->assertHasNoFormErrors();

    // Assert the group was created in the database
    $this->assertDatabaseHas('index_groups', [
        'name' => 'Test Group',
    ]);
});

it('can edit an index group', function (): void {
    // Create a group
    $group = IndexGroup::factory()->create();

    // Edit the group
    livewire(IndexGroupResource\Pages\EditIndexGroup::class, [
        'record' => $group->id,
    ])
        ->fillForm([
            'name' => 'Updated Group Name',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    // Assert the group was updated in the database
    $this->assertDatabaseHas('index_groups', [
        'id' => $group->id,
        'name' => 'Updated Group Name',
    ]);
});

it('validates required fields when creating a group', function (): void {
    livewire(IndexGroupResource\Pages\CreateIndexGroup::class)
        ->fillForm([
            'name' => '',
        ])
        ->call('create')
        ->assertHasFormErrors(['name' => 'required']);
});
