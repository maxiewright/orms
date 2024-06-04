<?php

namespace Modules\Legal\Tests\Feature;

use App\Models\Serviceperson;
use Modules\Legal\Enums\Incident\IncidentStatus;
use Modules\Legal\Filament\Resources\PreActionProtocolResource;
use Modules\Legal\Filament\Resources\PreActionProtocolResource\Pages\ManagePreActionProtocols;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondence;
use Modules\Legal\Models\Incident;
use Modules\Legal\Models\LegalAction\Defendant;
use Modules\Legal\Models\LegalAction\PreActionProtocol;
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

it('gets the preActionProtocols index page', function () {
    get(PreActionProtocolResource::getUrl())->assertSuccessful();
});

it('lists preActionProtocols', function () {
    // Arrange
    $preActionProtocols = PreActionProtocol::factory()->count(5)->create();
    // Act and Assert
    livewire(ManagePreActionProtocols::class)
        ->assertCanSeeTableRecords($preActionProtocols);
});

it('creates an pre action protocol', function () {

    $servicepeople = Serviceperson::factory()->count(2)->make()->pluck('number')->toArray();
    $defendants = Defendant::factory()->create()->pluck('id')->toArray();
    $preActionProtocol = PreActionProtocol::factory()
        ->hasClaimants(2)
        ->hasDefendants(2)
        ->make();

    livewire(ManagePreActionProtocols::class)
        ->callAction('create', $preActionProtocol->toArray() +
            [
                'serviceperson_number' => $servicepeople,
                'defendants' => $defendants,
            ]
        );

    assertDatabaseHas(PreActionProtocol::class, $preActionProtocol->toArray());
});

// TODO - Test for existence of servicepeople
// TODO - Test for existence of defendants

it('creates pre action protocol with references', function () {
    // Arrange
    $references = LegalCorrespondence::factory(2)->create();
    $preActionProtocolWithReferences = PreActionProtocol::factory()->make();

    // Act and Assert
    livewire(ManagePreActionProtocols::class)
        ->assertActionExists('create')
        ->callAction('create', $preActionProtocolWithReferences->toArray() + [
            'references' => [
                $references->where('id', 1)->first()->id,
                $references->where('id', 2)->first()->id,
            ],
        ])
        ->assertHasNoActionErrors();

    expect(PreActionProtocol::first())->references->toHaveCount(2);
});

it('shows an pre action protocol', function () {
    $preActionProtocol = PreActionProtocol::factory()->create();

    livewire(ManagePreActionProtocols::class)
        ->assertTableActionExists('view')
        ->callTableAction('view', $preActionProtocol)
        ->assertSee([
            // Serviceperson Section
            $preActionProtocol->serviceperson->military_name,
            $preActionProtocol->serviceperson->battalion->short_name,
            $preActionProtocol->serviceperson->company->short_name,
            //Incident Section
            ucfirst($preActionProtocol->incident->type->value),
            // PreActionProtocol
            $preActionProtocol->correctionalFacility->name,
        ]);

});

it('retrieves an pre action protocol', function () {
    // Arrange
    $preActionProtocol = PreActionProtocol::factory()->create();
    // Act and Assert
    livewire(ManagePreActionProtocols::class, ['record' => $preActionProtocol])
        ->assertTableActionExists('edit')
        ->callTableAction('edit', $preActionProtocol)
        ->assertSee([
            // Serviceperson Section
            $preActionProtocol->serviceperson->military_name,
            $preActionProtocol->serviceperson->battalion->short_name,
            $preActionProtocol->serviceperson->company->short_name,
            //Incident Section
            ucfirst($preActionProtocol->incident->type->value),
            // PreActionProtocol
            $preActionProtocol->correctionalFacility->name,
        ]);
});

it('updates in pre action protocol', function () {

    $preActionProtocol = PreActionProtocol::factory()->create([
        'particulars' => 'This is an old pre action protocol description',
    ]);

    livewire(ManagePreActionProtocols::class, ['record' => $preActionProtocol])
        ->callTableAction('edit', $preActionProtocol, [
            'particulars' => 'This is an updated pre action protocol',
        ]);

    assertDatabaseHas(PreActionProtocol::class, [
        'particulars' => 'This is an updated pre action protocol',
    ]);

});

it('soft deletes an pre action protocol', function () {
    // Arrange
    $preActionProtocol = PreActionProtocol::factory()->create();
    // Act and Assert
    $preActionProtocol->delete();

    assertSoftDeleted($preActionProtocol);

});

it('restores a soft deleted pre action protocol', function () {
    // Arrange
    $preActionProtocol = PreActionProtocol::factory()->create();
    // Act and Assert

    $preActionProtocol->delete();

    assertSoftDeleted($preActionProtocol);

    $preActionProtocol->restore();

    expect($preActionProtocol->refresh()->deleted_at)->toBe(null);
});

it('force deletes an pre action protocol', function () {
    // Arrange
    $preActionProtocol = PreActionProtocol::factory()->create();
    // Act and Assert
    $preActionProtocol->forceDelete();

    assertModelMissing($preActionProtocol);
});

// todo - make charge test and test for charges being deleted if incident is (soft and force)

it('soft deletes an pre action protocol if the related incident is deleted', function () {
    // Arrange
    $incident = Incident::factory()->whereStatus(IncidentStatus::Charged)->create();
    $preActionProtocol = PreActionProtocol::factory()
        ->for($incident)
        ->create();
    // Act and Assert

    expect($incident->preActionProtocols()->exists())->toBeTrue()
        ->and($preActionProtocol->incident()->exists())->toBeTrue();
    assertDatabaseHas('incidents', $incident->getAttributes());
    assertDatabaseHas('preActionProtocols', $preActionProtocol->getAttributes());

    $incident->delete();

    assertSoftDeleted($incident);
    assertSoftDeleted($preActionProtocol);
});

it('restores an pre action protocol if the related incident is restored', function () {
    // Arrange
    $incident = Incident::factory()->create();
    $preActionProtocol = PreActionProtocol::factory()->for($incident)->create();
    // Act and Assert

    $incident->delete();
    assertSoftDeleted($preActionProtocol);

    $incident->restore();

    expect($preActionProtocol->refresh())->deleted_at->toBe(null);
});

it('deletes an pre action protocol if the related incident is force deleted', function () {
    // Arrange
    $incident = Incident::factory()->whereStatus(IncidentStatus::Charged)->create();
    $preActionProtocol = PreActionProtocol::factory()->for($incident)->create();

    // Act and Assert

    expect($incident->preActionProtocols()->exists())->toBeTrue()
        ->and($preActionProtocol->incident()->exists())->toBeTrue();
    assertDatabaseHas('incidents', $incident->getAttributes());
    assertDatabaseHas('preActionProtocols', $preActionProtocol->getAttributes());

    $incident->forceDelete();

    assertDatabaseMissing('preActionProtocols', $preActionProtocol->getAttributes());
    assertModelMissing($incident);
    assertModelMissing($preActionProtocol);

});
