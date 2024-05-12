<?php

namespace Modules\Legal\Tests\Unit;

use App\Models\Metadata\Contact\Division;
use App\Models\Serviceperson;
use Modules\Legal\Enums\InfractionStatus;
use Modules\Legal\Filament\Resources\InfractionResource\Pages\CreateInfraction;
use Modules\Legal\Models\Infraction;
use Tests\TestCase;

use function Pest\Livewire\livewire;

uses(TestCase::class);

beforeEach(function () {
    filament()->setCurrentPanel(
        filament()->getPanel('legal')
    );
});

it('can create an infraction', function () {
    //    $infraction = Infraction::factory()->create();

    $division = Division::all()->random()->id;
    $city = Division::find($division)->cities->random()->id;

    livewire(CreateInfraction::class)
        ->fillForm([
            'serviceperson_number' => Serviceperson::factory()->enlisted(),
            'occurred_at' => fake()->dateTime(),
            'address_line_1' => fake()->address(),
            'address_line_2' => fake()->address(),
            'division_id' => $division,
            'city_id' => $city,
            'status' => fake()->randomElement(InfractionStatus::cases()),
            'particulars' => fake()->sentence(),
        ])->call('create')
        ->assertHasFormErrors();

});
