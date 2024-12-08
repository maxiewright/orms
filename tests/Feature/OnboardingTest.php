<?php

use App\Models\Serviceperson;
use App\Models\User;

beforeEach(function () {

    $serviceperson = Serviceperson::factory()
        ->officer()
        ->has(User::factory())
        ->create();

    $this->user = $serviceperson->user->assignRole('super_admin');

});

it('does not allow user to view dashboard if password is not changed', function () {

    logInAsUserWithRole()->update([
        'password_changed_at' => null,
    ]);

    $this->get('/admin')
        ->assertRedirect(route('filament.admin.filament.onboard.onboard'));
});

it('allows user to access the dashboard if password is changed', function () {
    $this->actingAs($this->user);

    $this->get(route('filament.admin.filament.onboard.onboard'))->assertSuccessful();

    // submit the password change form
    // assert that the user see the dashboard
})->todo();
