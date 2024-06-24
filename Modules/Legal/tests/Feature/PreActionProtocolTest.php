<?php

namespace Modules\Legal\Tests\Feature;

use App\Models\Serviceperson;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Modules\Legal\Enums\LegalProfessionalType;
use Modules\Legal\Filament\Resources\PreActionProtocolResource;
use Modules\Legal\Filament\Resources\PreActionProtocolResource\Pages\ManagePreActionProtocols;
use Modules\Legal\Jobs\ProcessImminentAndDefaultedPreActionProtocols;
use Modules\Legal\Models\Ancillary\CourtAppearance\LegalProfessional;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondence;
use Modules\Legal\Models\LegalAction\Defendant;
use Modules\Legal\Models\LegalAction\PreActionProtocol;
use Modules\Legal\Notifications\SendPreActionProtocolDefaultedNotification;
use Modules\Legal\Notifications\SendPreActionProtocolResponseImminentNotification;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseHas;
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

    $claimants = Serviceperson::factory()->count(2)->create()->pluck('number')->toArray();
    $defendants = Defendant::factory()->count(2)->create()->pluck('id')->toArray();
    $legalRepresentatives = LegalProfessional::factory()
        ->whereType(LegalProfessionalType::Lawyer)
        ->create()->pluck('id')->toArray();
    $preActionProtocol = PreActionProtocol::factory()->make();

    $data = $preActionProtocol->toArray() + [
        'claimants' => $claimants,
        'legalRepresentatives' => $legalRepresentatives,
        'defendants' => $defendants,
    ];

    livewire(ManagePreActionProtocols::class)->callAction('create', $data);

    $newPreActionProtocol = PreActionProtocol::query()->get()->first();

    expect($newPreActionProtocol->defendants()->count())->toBe(2)
        ->and($newPreActionProtocol->legalRepresentatives()->exists())->toBe(true)
        ->and($newPreActionProtocol->claimants()->count())->toBe(2);

    assertDatabaseHas(PreActionProtocol::class, $preActionProtocol->toArray());
});

it('creates pre action protocol with references', function () {
    // Arrange
    $references = LegalCorrespondence::factory(2)->create();
    $preActionProtocolWithReferences = PreActionProtocol::factory()->make();
    $claimants = Serviceperson::factory()->count(2)->make()->pluck('number')->toArray();
    $defendants = Defendant::factory()->count(2)->create()->pluck('id')->toArray();
    $legalRepresentatives = LegalProfessional::factory()
        ->whereType(LegalProfessionalType::Lawyer)
        ->create()->pluck('id')->toArray();

    // Act and Assert
    livewire(ManagePreActionProtocols::class)
        ->assertActionExists('create')
        ->callAction('create', $preActionProtocolWithReferences->toArray() + [
            'claimants' => $claimants,
            'legalRepresentatives' => $legalRepresentatives,
            'defendants' => $defendants,
            'references' => [
                $references->where('id', 1)->first()->id,
                $references->where('id', 2)->first()->id,
            ],
        ])
        ->assertHasNoActionErrors();

    expect(PreActionProtocol::first())->references->toHaveCount(2);
});

it('shows an pre action protocol', function () {
    $preActionProtocol = PreActionProtocol::factory()
        ->hasClaimants(3)
        ->hasDefendants()
        ->hasLegalRepresentatives()
        ->hasReferences()
        ->create();

    $claimants = $preActionProtocol->claimants->map(fn ($claimant) => $claimant->military_name)->toArray();
    $defendants = $preActionProtocol->defendants->map(fn ($defendant) => $defendant->name)->toArray();
    $legalRepresentatives = $preActionProtocol->legalRepresentatives->map(fn ($legalRepresentative) => $legalRepresentative->name)->toArray();

    livewire(ManagePreActionProtocols::class)
        ->assertTableActionExists('view')
        ->callTableAction('view', $preActionProtocol)
        ->assertSee($claimants + $defendants + $legalRepresentatives + [
            $preActionProtocol->toArray(),
        ]);

});

it('retrieves an pre action protocol', function () {
    // Arrange
    $preActionProtocol = PreActionProtocol::factory()
        ->hasClaimants(2)
        ->hasDefendants(2)
        ->hasLegalRepresentatives(3)
        ->hasReferences()
        ->create();

    $claimants = $preActionProtocol->claimants->map(fn ($claimant) => $claimant->military_name)->toArray();
    $defendants = $preActionProtocol->defendants->map(fn ($defendant) => $defendant->name)->toArray();
    $legalRepresentatives = $preActionProtocol->legalRepresentatives->map(fn ($legalRepresentative) => $legalRepresentative->name)
        ->toArray();

    // Act and Assert
    livewire(ManagePreActionProtocols::class, ['record' => $preActionProtocol])
        ->assertTableActionExists('edit')
        ->callTableAction('edit', $preActionProtocol)
        ->assertSee($claimants + $defendants + $legalRepresentatives + [
            $preActionProtocol->toArray(),
        ]);
});

it('updates in pre action protocol', function () {

    $preActionProtocol = PreActionProtocol::factory()
        ->hasClaimants(2)
        ->hasDefendants(2)
        ->hasLegalRepresentatives(3)
        ->hasReferences()
        ->create([
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

it('processes imminent and defaulted pre-action protocols when the schedule is called', function () {
    Queue::fake();

    preActionProtocol::factory()->responseImminent()->count(5)->create();

    Artisan::call('schedule:run');

    Queue::assertPushed(ProcessImminentAndDefaultedPreActionProtocols::class);
});

it('notifies the legal users of pre action protocol that require imminent responses', function () {

    Notification::fake();
    Queue::fake();

    PreActionProtocol::factory()->responseImminent()->count(5)->create();

    $legalUsers = User::factory()->count(5)->create()->each(function ($user) {
        $user->assignRole('legal_clerk');
    });

    $job = new ProcessImminentAndDefaultedPreActionProtocols();

    $job::dispatch();

    $job->handle();

    Queue::assertPushed(ProcessImminentAndDefaultedPreActionProtocols::class);

    Notification::assertSentTo($legalUsers, SendPreActionProtocolResponseImminentNotification::class);

});

it('notifies the legal users of defaulted  pre action protocols', function () {
    Notification::fake();
    Queue::fake();

    PreActionProtocol::factory()->defaulted()->count(5)->create();

    $legalUsers = User::factory()->count(5)->create()->each(function ($user) {
        $user->assignRole('legal_clerk');
    });

    $job = new ProcessImminentAndDefaultedPreActionProtocols();

    $job::dispatch();

    $job->handle();

    Queue::assertPushed(ProcessImminentAndDefaultedPreActionProtocols::class);

    Notification::assertSentTo($legalUsers, SendPreActionProtocolDefaultedNotification::class);
});
