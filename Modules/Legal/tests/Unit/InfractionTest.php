<?php

namespace Modules\Legal\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Legal\Filament\Resources\InfractionResource\Pages\CreateInfraction;
use Modules\Legal\Models\Infraction;
use Tests\TestCase;

use function Pest\Livewire\livewire;

uses(TestCase::class, WithFaker::class, RefreshDatabase::class);

it('can create an infraction', function () {
    $infraction = Infraction::factory()->create();

    livewire(CreateInfraction::class)
        ->fillForm([

        ])->call('create')
        ->assertHasFormErrors();

});
