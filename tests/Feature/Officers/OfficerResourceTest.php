<?php

use App\Filament\Resources\OfficerResource;

use function Pest\Laravel\get;

it('can access the officers resource', function (): void {
    // Act & Assert
    logInAsUserWithRole();

    get(OfficerResource::getUrl())
        ->assertSuccessful();
});
