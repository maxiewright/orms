<?php

use App\Filament\Resources\OfficerResource;

it('can access the officers resource', function () {
    // Act & Assert
    logInAsUserWithRole()
        ->get(OfficerResource::getUrl())
        ->assertSuccessful();
});
