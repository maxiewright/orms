<?php

namespace Modules\Legal\Tests\Feature;

use Modules\Legal\Enums\Incident\IncidentStatus;
use Modules\Legal\Enums\InterdictionStatus;
use Modules\Legal\Filament\Resources\InterdictionResource;
use Modules\Legal\Filament\Resources\InterdictionResource\Pages\CreateInterdiction;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondence;
use Modules\Legal\Models\Incident;
use Modules\Legal\Models\Interdiction;
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

it('gets the interdictions index page', function () {
    get(InterdictionResource::getUrl('index'))->assertSuccessful();
});

it('lists interdictions', function () {
    // Arrange
    $interdictions = Interdiction::factory()->count(5)->create();
    // Act and Assert
    livewire(InterdictionResource\Pages\ListInterdiction::class)
        ->assertCanSeeTableRecords($interdictions);
});

it('creates an interdiction', function () {
    $interdiction = Interdiction::factory()->make();

    livewire(CreateInterdiction::class)
        ->fillForm($interdiction->toArray())
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas(Interdiction::class, $interdiction->toArray());
});

it('creates interdiction with references', function () {
    // Arrange
    $references = LegalCorrespondence::factory(2)->create();
    $interdictionWithReferences = Interdiction::factory()->make();

    // Act and Assert
    livewire(CreateInterdiction::class)
        ->fillForm($interdictionWithReferences->toArray() + [
            'references' => [
                $references->where('id', 1)->first()->id,
                $references->where('id', 2)->first()->id,
            ],
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Interdiction::first())->references->toHaveCount(2);
});

it('shows an interdiction', function () {
    $interdiction = Interdiction::factory()->create();

    livewire(InterdictionResource\Pages\ViewInterdiction::class, [
        'record' => $interdiction->getRouteKey(),
    ])->assertSee([
        // Serviceperson Section
        $interdiction->serviceperson->military_name,
        $interdiction->serviceperson->battalion->short_name,
        $interdiction->serviceperson->company->short_name,
        //Incident Section
        ucfirst($interdiction->incident->type->value),
        ucfirst($interdiction->incident->status->value),
        // Interdiction
        ucfirst($interdiction->status->value),
    ]);
});

it('retrieves an interdiction', function () {
    // Arrange
    $interdiction = Interdiction::factory()->create();
    // Act and Assert
    livewire(InterdictionResource\Pages\EditInterdiction::class, [
        'record' => $interdiction->getRouteKey(),
    ])->assertFormSet($interdiction->toArray());
});

it('updates in interdiction', function () {
    // Arrange
    $interdiction = Interdiction::factory()->create();

    // Act and Assert
    livewire(InterdictionResource\Pages\EditInterdiction::class, [
        'record' => $interdiction->getRouteKey(),
    ])
        ->fillForm([
            'status' => InterdictionStatus::Interdicted,
            'interdicted_at' => now(),
            'particulars' => 'This is an updated interdiction',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($interdiction->refresh())
        ->status->toBe(InterdictionStatus::Interdicted)
        ->interdicted_at->toDate();

    assertDatabaseHas('interdictions', [
        'particulars' => 'This is an updated interdiction',
    ]);
});

it('soft deletes an interdiction', function () {
    // Arrange
    $interdiction = Interdiction::factory()->create();
    // Act and Assert
    $interdiction->delete();

    assertSoftDeleted($interdiction);

});

it('restores a soft deleted interdiction', function () {
    // Arrange
    $interdiction = Interdiction::factory()->create();
    // Act and Assert

    $interdiction->delete();

    assertSoftDeleted($interdiction);

    $interdiction->restore();

    expect($interdiction->refresh()->deleted_at)->toBe(null);
});

it('force deletes an interdiction', function () {
    // Arrange
    $interdiction = Interdiction::factory()->create();
    // Act and Assert
    $interdiction->forceDelete();

    assertModelMissing($interdiction);
});

// todo - make charge test and test for charges being deleted if incident is (soft and force)

it('soft deletes an interdiction if the related incident is deleted', function () {
    // Arrange
    $incident = Incident::factory()->whereStatus(IncidentStatus::Charged)->create();
    $interdiction = Interdiction::factory()
        ->for($incident)
        ->create();
    // Act and Assert

    expect($incident->interdiction->exists())->toBeTrue()
        ->and($interdiction->incident->exists())->toBeTrue();
    assertDatabaseHas('incidents', $incident->getAttributes());
    assertDatabaseHas('interdictions', $interdiction->getAttributes());

    $incident->delete();

    assertSoftDeleted($incident);
    assertSoftDeleted($interdiction);
});

it('restores an interdiction if the related incident is restored', function () {
    // Arrange
    $incident = Incident::factory()->create();
    $interdiction = Interdiction::factory()->for($incident)->create();
    // Act and Assert

    $incident->delete();
    assertSoftDeleted($interdiction);

    $incident->restore();

    expect($interdiction->refresh())->deleted_at->toBe(null);
});

it('deletes an interdiction if the related incident is force deleted', function () {
    // Arrange
    $incident = Incident::factory()->whereStatus(IncidentStatus::Charged)->create();
    $interdiction = Interdiction::factory()->for($incident)->create();

    // Act and Assert

    expect($incident->interdiction->exists())->toBeTrue()
        ->and($interdiction->incident->exists())->toBeTrue();
    assertDatabaseHas('incidents', $incident->getAttributes());
    assertDatabaseHas('interdictions', $interdiction->getAttributes());

    $incident->forceDelete();

    assertDatabaseMissing('interdictions', $interdiction->getAttributes());
    assertModelMissing($incident);
    assertModelMissing($interdiction);

});
