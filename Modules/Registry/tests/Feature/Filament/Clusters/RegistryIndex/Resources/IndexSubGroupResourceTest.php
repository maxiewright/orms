<?php

use Modules\Registry\Models\RegistryIndex\IndexGroup;
use Modules\Registry\Models\RegistryIndex\IndexSubGroup;
use Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexSubGroupResource;
use function Pest\Livewire\livewire;

use Modules\Registry\Tests\TestCase\RegistryTestCase;

uses(RegistryTestCase::class);

it('can render index page', function () {
    $this->get(IndexSubGroupResource::getUrl('index'))
        ->assertSuccessful();
});

it('can list index subgroups', function () {
    // Create some index subgroups
    $subgroups = IndexSubGroup::factory()->count(5)->create();

    // Test the Livewire component
    livewire(IndexSubGroupResource\Pages\ListIndexSubGroups::class)
        ->assertCanSeeTableRecords($subgroups);
});

it('can create an index subgroup', function () {
    // Create a group first
    $group = IndexGroup::factory()->create();

    $newSubGroup = [
        'reference_number' => '1/2',
        'name' => 'Test Subgroup',
        'index_group_id' => $group->id,
    ];

    livewire(IndexSubGroupResource\Pages\CreateIndexSubGroup::class)
        ->fillForm($newSubGroup)
        ->call('create')
        ->assertHasNoFormErrors();

    // Assert the subgroup was created in the database
    $this->assertDatabaseHas('index_sub_groups', [
        'name' => 'Test Subgroup',
        'reference_number' => '1/2',
        'index_group_id' => $group->id,
    ]);
});

it('can edit an index subgroup', function () {
    // Create a subgroup
    $subgroup = IndexSubGroup::factory()->create();

    // Edit the subgroup
    livewire(IndexSubGroupResource\Pages\EditIndexSubGroup::class, [
        'record' => $subgroup->id,
    ])
        ->fillForm([
            'name' => 'Updated Subgroup Name',
            'reference_number' => '2/3',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    // Assert the subgroup was updated in the database
    $this->assertDatabaseHas('index_sub_groups', [
        'id' => $subgroup->id,
        'name' => 'Updated Subgroup Name',
        'reference_number' => '2/3',
    ]);
});

it('validates required fields when creating a subgroup', function () {
    livewire(IndexSubGroupResource\Pages\CreateIndexSubGroup::class)
        ->fillForm([
            'name' => '',
            'reference_number' => '',
            'index_group_id' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'name' => 'required',
            'reference_number' => 'required',
            'index_group_id' => 'required',
        ]);
});
