<?php

use App\Models\Serviceperson;

it('can be created', function () {
    // Arrange
    Serviceperson::factory(10)

        ->enlisted()
        ->create();

    // Act and Assert

});
