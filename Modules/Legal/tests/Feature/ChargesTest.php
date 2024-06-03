<?php

namespace Modules\Legal\Tests\Feature;

use Modules\Legal\Models\Incident;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\assertSoftDeleted;

uses(TestCase::class);

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('legal'));
});

it('soft deletes a charge', function () {
    // Arrange
    $incident = Incident::factory()->hasCharges()->create();
    $charge = $incident->charges()->first();

    // Act and Assert
    $charge->delete();

    assertSoftDeleted($charge);
});

it('force deletes an charge', function () {
    // Arrange
    $incident = Incident::factory()->hasCharges()->create();
    $charge = $incident->charges()->first();

    // Act and Assert
    $charge->forceDelete();

    assertModelMissing($charge);
});

it('soft deletes an charge if the related incident is deleted', function () {
    // Arrange
    $incident = Incident::factory()->hasCharges()->create();
    $charge = $incident->charges()->first();
    // Act and Assert

    expect($incident->charges()->exists())->toBeTrue()
        ->and($charge->incident()->exists())->toBeTrue();
    assertDatabaseHas('incidents', $incident->getAttributes());
    assertDatabaseHas('charges', $charge->getAttributes());

    $incident->delete();

    assertSoftDeleted($incident);
    assertSoftDeleted($charge);
});

it('restores charges if the related incident is restored', function () {
    // Arrange
    $incident = Incident::factory()->hasCharges()->create();
    $charge = $incident->charges()->first();
    // Act and Assert

    $incident->delete();
    assertSoftDeleted($charge);

    $incident->restore();

    expect($charge->refresh())->deleted_at->toBe(null);
});

it('deletes an charge if the related incident is force deleted', function () {
    // Arrange
    $incident = Incident::factory()->hasCharges()->create();
    $charge = $incident->charges()->first();

    // Act and Assert

    expect($incident->charges()->exists())->toBeTrue()
        ->and($charge->incident->exists())->toBeTrue();
    assertDatabaseHas('incidents', $incident->getAttributes());
    assertDatabaseHas('charges', $charge->getAttributes());

    $incident->forceDelete();

    assertDatabaseMissing('charges', $charge->getAttributes());
    assertModelMissing($incident);
    assertModelMissing($charge);
});
