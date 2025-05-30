<?php

use Modules\Registry\Models\RegistryIndex\IndexGroup;
use Modules\Registry\Models\RegistryIndex\IndexSubGroup;
use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexSubjectResource;
use Modules\Registry\Tests\TestCase\RegistryTestCase;
use function Pest\Livewire\livewire;

uses(RegistryTestCase::class);

// Skip authentication for now
// beforeEach(function () {
//     // Login as admin user
//     logInAsUserWithRole();
// });

it('can render index page', function () {
    $this->get(IndexSubjectResource::getUrl('index'))
        ->assertSuccessful();
});

it('can list index subjects', function () {
    // Create some index subjects
    $subjects = IndexSubject::factory()->count(5)->create();

    // Test the Livewire component
    livewire(IndexSubjectResource\Pages\ListIndexSubjects::class)
        ->assertCanSeeTableRecords($subjects);
});

it('can create an index subject', function () {
    // Create a group and subgroup first
    $group = IndexGroup::factory()->create();
    $subgroup = IndexSubGroup::factory()->forGroup($group)->create();

    $newSubject = [
        'reference_number' => '1/2/3',
        'name' => 'Test Subject',
        'index_group_id' => $group->id,
        'index_sub_group_id' => $subgroup->id,
    ];

    livewire(IndexSubjectResource\Pages\CreateIndexSubject::class)
        ->fillForm($newSubject)
        ->call('create')
        ->assertHasNoFormErrors();

    // Assert the subject was created in the database
    $this->assertDatabaseHas('index_subjects', [
        'name' => 'Test Subject',
        'reference_number' => '1/2/3',
        'index_sub_group_id' => $subgroup->id,
    ]);
});

it('can edit an index subject', function () {
    // Create a subject
    $subject = IndexSubject::factory()->create();

    // Edit the subject
    livewire(IndexSubjectResource\Pages\EditIndexSubject::class, [
        'record' => $subject->id,
    ])
        ->fillForm([
            'name' => 'Updated Subject Name',
            'reference_number' => '3/4/5',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    // Assert the subject was updated in the database
    $this->assertDatabaseHas('index_subjects', [
        'id' => $subject->id,
        'name' => 'Updated Subject Name',
        'reference_number' => '3/4/5',
    ]);
});

it('validates required fields when creating a subject', function () {
    livewire(IndexSubjectResource\Pages\CreateIndexSubject::class)
        ->fillForm([
            'name' => '',
            'reference_number' => '',
            'index_group_id' => null,
            'index_sub_group_id' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'name' => 'required',
            'reference_number' => 'required',
            'index_group_id' => 'required',
            'index_sub_group_id' => 'required',
        ]);
});
