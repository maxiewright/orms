<?php

namespace Modules\Legal\Tests\Unit;

use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Repeater;
use Modules\Legal\Enums\Incident\IncidentStatus;
use Modules\Legal\Filament\Resources\IncidentResource;
use Modules\Legal\Filament\Resources\IncidentResource\Pages\CreateIncident;
use Modules\Legal\Filament\Resources\IncidentResource\Pages\EditIncident;
use Modules\Legal\Filament\Resources\IncidentResource\Pages\ListIncidents;
use Modules\Legal\Filament\Resources\IncidentResource\Pages\ViewIncident;
use Modules\Legal\Models\Charge;
use Modules\Legal\Models\Incident;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

uses(TestCase::class);

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('legal'));
});

it('shows the incidents index page', function () {
    get(IncidentResource::getUrl('index'))->assertSuccessful();
});

it('shows a list of incidents', function () {
    // Arrange
    $incidents = Incident::factory()
        ->whereStatus(IncidentStatus::PendingCharge)
        ->count(5)->create();

    // Act and Assert
    livewire(ListIncidents::class)
        ->assertCanSeeTableRecords($incidents);
});

it('shows the incidents create page', function () {
    get(IncidentResource::getUrl('create'))->assertSuccessful();
});

it('can create an incident without charge', function () {

    $fakeRepeater = Repeater::fake();

    $newIncident = Incident::factory()->whereStatus(IncidentStatus::PendingCharge)->make();

    $newIncident['status'] = IncidentStatus::PendingCharge->value;

    livewire(CreateIncident::class)
        ->fillForm(getIncidentAttributes($newIncident))
        ->call('create')
        ->assertHasNoFormErrors();

    // assert that the database has an incident
    assertDatabaseHas('incidents', getIncidentAttributes($newIncident));

    expect(Incident::first()->charges()->count())->toBe(0);

    $fakeRepeater();

});

it('can create an incident with charge', function () {

    $newIncident = Incident::factory()->make();

    $incident = getIncidentAttributes($newIncident);

    $incident['status'] = IncidentStatus::Charged->value;

    $charge1 = Charge::factory()->make();
    $charge2 = Charge::factory()->make();

    $fakeRepeater = Repeater::fake();

    livewire(CreateIncident::class)
        ->fillForm($incident + [
            'charges' => [
                getChargeAttributes($charge1),
                getChargeAttributes($charge2),
            ],
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas('charges', $charge1->toArray());

    expect(Incident::first()->charges()->count())->toBe(2);

    $fakeRepeater();
});

it('shows the incident view page', function () {
    $incident = Incident::factory()->whereStatus(IncidentStatus::Charged)->hasCharges(2)->create();
    $firstCharge = $incident->charges->first();

    ray($firstCharge);

    get(IncidentResource::getUrl('view', [
        'record' => $incident,
    ]))
        ->assertSuccessful()
        ->assertSeeInOrder([
            $incident->serviceperson->military_name,
            $incident->address,
            $firstCharge->offenceSection->name,
            $firstCharge->policeStation?->name,
        ]);
});

it('can add a charge on the view page', function () {
    // Arrange
    $incident = Incident::factory()->whereStatus(IncidentStatus::PendingCharge)->create();
    $charge = Charge::factory()->make();

    expect($incident->charges()->count())->toBe(0);

    // Act and Assert
    livewire(ViewIncident::class, ['record' => $incident->getRouteKey()])
        ->callAction('Add Charges', data: getChargeAttributes($charge))
        ->assertHasNoActionErrors();

    expect($incident->charges()->count())->toBe(1);
});

it('shows the incident edit page', function () {
    get(IncidentResource::getUrl('edit', [
        'record' => Incident::factory()->create(),
    ]))->assertSuccessful();
});

it('sets the incident with charges on the incident edit page', function () {
    $fakeRepeater = Repeater::fake();
    // Arrange
    $incident = Incident::factory()
        ->whereStatus(IncidentStatus::Charged)
        ->hasCharges(2)
        ->create();

    $firstCharge = $incident->charges->first()->toArray();
    $secondCharge = $incident->charges->last()->toArray();

    // Act and Assert
    livewire(EditIncident::class, ['record' => $incident->getRouteKey()])
        ->assertFormSet([
            'name' => $incident->name,
            'type' => $incident->type->value,
            'charges' => [
                $firstCharge,
                $secondCharge,
            ],
        ]);

    $fakeRepeater();
});

it('sets all charges for the incident on the edit page', function () {
    $fakeRepeater = Repeater::fake();
    // Arrange
    $incident = Incident::factory()->hasCharges(2)->create();

    // Act and Assert
    livewire(EditIncident::class, ['record' => $incident->getRouteKey()])
        ->assertFormSet(function (array $state) {
            expect($state['charges'])->toHaveCount(2);
        });

    $fakeRepeater();
});

it('can save an edited incident', function () {
    $fakeRepeater = Repeater::fake();
    // Arrange
    $incident = Incident::factory()->whereStatus(IncidentStatus::PendingCharge)->create();
    $newCharge = Charge::factory()->make();
    // Act and Assert

    livewire(EditIncident::class, ['record' => $incident->getRouteKey()])
        ->fillForm([
            'status' => IncidentStatus::Charged,
            'charges' => [
                getChargeAttributes($newCharge),
            ],
        ])->call('save')
        ->assertHasNoFormErrors();

    expect($incident->refresh())
        ->status->toBe(IncidentStatus::Charged)
        ->charges->toHaveCount(1);

    $fakeRepeater();
});

it('can soft delete an incident', function () {
    // Arrange
    $incident = Incident::factory()->create();
    // Act and Assert
    livewire(EditIncident::class, ['record' => $incident->getRouteKey()])
        ->callAction(DeleteAction::class);

    $this->assertSoftDeleted($incident);

});

function getIncidentAttributes(Incident $incident): array
{
    return [
        'name' => $incident->name,
        'type' => $incident->type->value,
        'serviceperson_number' => $incident->serviceperson_number,
        'occurred_at' => $incident->occurred_at->format('Y-m-d H:i'),
        'address_line_1' => $incident->address_line_1,
        'address_line_2' => $incident->address_line_2,
        'division_id' => $incident->division_id,
        'city_id' => $incident->city_id,
        'status' => $incident->status->value,
        'particulars' => $incident->particulars,
    ];
}

function getChargeAttributes(Charge $charge): array
{

    return [
        'offence_type' => $charge->offence_type,
        'offence_division_id' => $charge->offence_division_id,
        'offence_section_id' => $charge->offence_section_id,
        'charged_at' => $charge->charged_at,
        'justice_institution_id' => $charge->justice_institution_id,
        'charged_by' => $charge->charged_by,
    ];

}
