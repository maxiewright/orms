<?php

namespace Modules\Legal\Tests\Feature;

use Modules\Legal\Enums\Incident\IncidentStatus;
use Modules\Legal\Filament\Resources\IncarcerationResource;
use Modules\Legal\Filament\Resources\IncarcerationResource\Pages\ManageIncarcerations;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondence;
use Modules\Legal\Models\Incarceration;
use Modules\Legal\Models\Incident;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

uses(TestCase::class);

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('legal'));
});

it('gets the incarcerations index page', function () {
    get(IncarcerationResource::getUrl())->assertSuccessful();
});

it('lists incarcerations', function () {
    // Arrange
    $incarcerations = Incarceration::factory()->count(5)->create();
    // Act and Assert
    livewire(ManageIncarcerations::class)->assertCanSeeTableRecords($incarcerations);
});

it('creates an incarceration', function () {
    $incarceration = Incarceration::factory()->make();

    livewire(ManageIncarcerations::class)
        ->callAction('create', $incarceration->toArray())
        ->assertHasNoActionErrors();

    assertDatabaseHas(Incarceration::class, $incarceration->toArray());
});

it('creates incarceration with references', function () {
    // Arrange
    $references = LegalCorrespondence::factory(2)->create();
    $incarcerationWithReferences = Incarceration::factory()->make();

    // Act and Assert
    livewire(ManageIncarcerations::class)
        ->assertActionExists('create')
        ->callAction('create', $incarcerationWithReferences->toArray() + [
            'references' => [
                $references->where('id', 1)->first()->id,
                $references->where('id', 2)->first()->id,
            ],
        ])
        ->assertHasNoActionErrors();

    expect(Incarceration::first())->references->toHaveCount(2);
});

it('shows an incarceration', function () {
    $incarceration = Incarceration::factory()->create();

    livewire(ManageIncarcerations::class)
        ->assertTableActionExists('view')
        ->callTableAction('view', $incarceration)
        ->assertSee([
            // Serviceperson Section
            $incarceration->serviceperson->military_name,
            $incarceration->serviceperson->battalion->short_name,
            $incarceration->serviceperson->company->short_name,
            //Incident Section
            ucfirst($incarceration->incident->type->value),
            // Incarceration
            $incarceration->correctionalFacility->name,
        ]);

});

it('retrieves an incarceration', function () {
    // Arrange
    $incarceration = Incarceration::factory()->create();
    // Act and Assert
    livewire(ManageIncarcerations::class, ['record' => $incarceration])
        ->assertTableActionExists('edit')
        ->callTableAction('edit', $incarceration)
        ->assertSee([
            // Serviceperson Section
            $incarceration->serviceperson->military_name,
            $incarceration->serviceperson->battalion->short_name,
            $incarceration->serviceperson->company->short_name,
            //Incident Section
            ucfirst($incarceration->incident->type->value),
            // Incarceration
            $incarceration->correctionalFacility->name,
        ]);
});

it('updates in incarceration', function () {

    $incarceration = Incarceration::factory()->create([
        'particulars' => 'This is an old incarceration description',
    ]);

    livewire(ManageIncarcerations::class, ['record' => $incarceration])
        ->callTableAction('edit', $incarceration, [
            'particulars' => 'This is an updated incarceration',
        ]);

    assertDatabaseHas(Incarceration::class, [
        'particulars' => 'This is an updated incarceration',
    ]);

});

it('soft deletes an incarceration', function () {
    // Arrange
    $incarceration = Incarceration::factory()->create();
    // Act and Assert
    $incarceration->delete();

    assertSoftDeleted($incarceration);

});

it('restores a soft deleted incarceration', function () {
    // Arrange
    $incarceration = Incarceration::factory()->create();
    // Act and Assert

    $incarceration->delete();

    assertSoftDeleted($incarceration);

    $incarceration->restore();

    expect($incarceration->refresh()->deleted_at)->toBe(null);
});

it('force deletes an incarceration', function () {
    // Arrange
    $incarceration = Incarceration::factory()->create();
    // Act and Assert
    $incarceration->forceDelete();

    assertModelMissing($incarceration);
});

// todo - make charge test and test for charges being deleted if incident is (soft and force)

it('soft deletes an incarceration if the related incident is deleted', function () {
    // Arrange
    $incident = Incident::factory()->whereStatus(IncidentStatus::Charged)->create();
    $incarceration = Incarceration::factory()
        ->for($incident)
        ->create();
    // Act and Assert

    expect($incident->incarcerations()->exists())->toBeTrue()
        ->and($incarceration->incident()->exists())->toBeTrue();
    assertDatabaseHas('incidents', $incident->getAttributes());
    assertDatabaseHas('incarcerations', $incarceration->getAttributes());

    $incident->delete();

    assertSoftDeleted($incident);
    assertSoftDeleted($incarceration);
});

it('restores an incarceration if the related incident is restored', function () {
    // Arrange
    $incident = Incident::factory()->create();
    $incarceration = Incarceration::factory()->for($incident)->create();
    // Act and Assert

    $incident->delete();
    assertSoftDeleted($incarceration);

    $incident->restore();

    expect($incarceration->refresh())->deleted_at->toBe(null);
});

it('deletes an incarceration if the related incident is force deleted', function () {
    // Arrange
    $incident = Incident::factory()->whereStatus(IncidentStatus::Charged)->create();
    $incarceration = Incarceration::factory()->for($incident)->create();

    // Act and Assert

    expect($incident->incarcerations()->exists())->toBeTrue()
        ->and($incarceration->incident()->exists())->toBeTrue();
    assertDatabaseHas('incidents', $incident->getAttributes());
    assertDatabaseHas('incarcerations', $incarceration->getAttributes());

    $incident->forceDelete();

    assertDatabaseMissing('incarcerations', $incarceration->getAttributes());
    assertModelMissing($incident);
    assertModelMissing($incarceration);

});
