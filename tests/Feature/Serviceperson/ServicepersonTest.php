<?php

use App\Filament\Resources\ServicepersonResource;
use App\Filament\Resources\ServicepersonResource\Pages\ListServicepeople;
use App\Models\Serviceperson;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

beforeEach(function () {
    logInAsUserWithRole();
});

it('can list servicepeople', function () {
    $officer = Serviceperson::factory()->officer()->create();
    $enlisted = Serviceperson::factory()->enlisted()->create();

    livewire(ListServicepeople::class)
        ->assertSuccessful()
        ->assertSeeText([
            $officer->military_name,
            $enlisted->military_name,
        ]);

});

it('it displays the view page table record is clicked', function () {
    // Arrange
    $serviceperson = Serviceperson::factory()->officer()->create();

    // Act and Assert
    livewire(ListServicepeople::class)
        ->assertTableActionDoesNotExist(EditAction::class)
        ->assertTableActionExists(ViewAction::class)
        ->callTableAction(ViewAction::class, $serviceperson);

});

it('shows the serviceperson', function () {
    // Arrange
    $serviceperson = Serviceperson::factory()->officer()->create();

    // Act and Assert
    get(ServicepersonResource::getUrl('view', [
        'record' => $serviceperson,
    ]))->assertSuccessful();

});

todo('can add a new serviceperson');
todo('list servicepeople by rank desc and number asc by default');
todo('can visit the edit page from the view page only');
todo('can successfully edit a record');
todo('it send a notification when a record is added');
