<?php

use Modules\Registry\Models\RegistryIndex\IndexGroup;
use Modules\Registry\Models\RegistryIndex\IndexSubGroup;
use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Modules\Registry\Filament\Clusters\RegistryIndex\Pages\RegistryLookup;
use Modules\Registry\Tests\TestCase\RegistryTestCase;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

uses(RegistryTestCase::class);

// Skip authentication for now
// beforeEach(function () {
//     // Login as admin user
//     logInAsUserWithRole();
// });

it('can render the registry lookup page', function (): void {
    get(RegistryLookup::getUrl())
        ->assertSuccessful();
});

it('can perform dynamic lookup', function (): void {
    // Create test data
    $group = IndexGroup::factory()->create(['name' => 'Test Group']);
    $subgroup = IndexSubGroup::factory()->forGroup($group)->create([
        'name' => 'Test Subgroup',
        'reference_number' => '1/2'
    ]);
    $subject = IndexSubject::factory()->forSubGroup($subgroup)->create([
        'name' => 'Test Subject',
        'reference_number' => '1/2/3'
    ]);

    // Test the Livewire component
    $component = livewire(RegistryLookup::class)
        ->assertFormExists()
        ->assertFormFieldExists('indexGroup')
        ->assertFormFieldExists('indexSubGroup')
        ->assertFormFieldExists('indexSubject');

    // Select a group
    $component->fillForm(['indexGroup' => $group->id])
        ->assertFormFieldIsVisible('indexSubGroup');

    // Select a subgroup
    $component->fillForm(['indexSubGroup' => $subgroup->id])
        ->assertFormFieldIsVisible('indexSubject');

    // Select a subject
    $component->fillForm(['indexSubject' => $subject->id]);

    // Assert that the reference number is displayed
    $component->assertSee($subject->reference_number);
});

it('shows subgroup reference number when subgroup is selected', function (): void {
    // Create test data
    $group = IndexGroup::factory()->create();
    $subgroup = IndexSubGroup::factory()->forGroup($group)->create([
        'reference_number' => '1/2'
    ]);

    // Test the Livewire component
    livewire(RegistryLookup::class)
        ->fillForm(['indexGroup' => $group->id])
        ->fillForm(['indexSubGroup' => $subgroup->id])
        ->assertSee($subgroup->reference_number);
});

it('can perform reverse lookup by reference number', function (): void {
    // Create test data
    $group = IndexGroup::factory()->create(['name' => 'Test Group']);
    $subgroup = IndexSubGroup::factory()->forGroup($group)->create([
        'name' => 'Test Subgroup',
        'reference_number' => '1/2'
    ]);
    $subject = IndexSubject::factory()->forSubGroup($subgroup)->create([
        'name' => 'Test Subject',
        'reference_number' => '1/2/3'
    ]);

    // Test the Livewire component for subject lookup
    livewire(RegistryLookup::class)
        ->fillForm(['reverseLookupData.searchReferenceNumber' => '1/2/3'])
        ->assertSee('Test Subject')
        ->assertSee('Test Subgroup')
        ->assertSee('Test Group');

    // Test the Livewire component for subgroup lookup
    livewire(RegistryLookup::class)
        ->fillForm(['reverseLookupData.searchReferenceNumber' => '1/2'])
        ->assertSee('Test Subgroup')
        ->assertSee('Test Group');
});

it('shows no results message when no matches found in reverse lookup', function (): void {
    livewire(RegistryLookup::class)
        ->fillForm(['reverseLookupData.searchReferenceNumber' => 'nonexistent/reference'])
        ->assertSee('No matching records found');
});

it('can copy reference number to clipboard', function (): void {
    // This test would normally use browser testing to verify clipboard functionality
    // Since we can't test clipboard operations directly in PHPUnit, we'll just verify
    // that the copy button is present

    // Create test data
    $group = IndexGroup::factory()->create();
    $subgroup = IndexSubGroup::factory()->forGroup($group)->create([
        'reference_number' => '1/2'
    ]);
    $subject = IndexSubject::factory()->forSubGroup($subgroup)->create([
        'reference_number' => '1/2/3'
    ]);

    // Test the Livewire component
    livewire(RegistryLookup::class)
        ->fillForm(['indexGroup' => $group->id])
        ->fillForm(['indexSubGroup' => $subgroup->id])
        ->fillForm(['indexSubject' => $subject->id])
        ->assertSeeHtml('clipboard'); // Check for clipboard icon/button
});
