<?php

namespace Modules\ServiceFund\tests\Feature;

use Filament\Tables\Actions\DeleteAction;
use Modules\ServiceFund\App\Models\Contact;
use Modules\ServiceFund\Filament\App\Resources\ContactResource;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

uses(TestCase::class);

beforeEach(function () {
    logInAsUserWithRole();

    filament()->setCurrentPanel(
        filament()->getPanel('service-fund')
    );
});

it('shows the contact index page', function () {
    // Arrange, Act and Assert
    get(ContactResource::getUrl())
        ->assertSuccessful();
});

it('shows a list of contacts', function () {
    // Arrange
    $contacts = Contact::factory()->count(5)->create();
    // Act and Assert
    livewire(ContactResource\Pages\ListContacts::class)
        ->assertCanSeeTableRecords($contacts);
});

it('creates an contact', function () {
    // Arrange

    // Act and Assert
    livewire(ContactResource\Pages\CreateContact::class)
        ->fillForm([
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'website' => fake()->url,
            'address_line_1' => fake()->streetAddress(),
            'address_line_2' => null,
            'city_id' => app(config('servicefund.address.city'))::all()->random()->id,
            'added_by' => auth()->id(),
            'is_active' => fake()->randomElement([0, 1]),
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $contact = Contact::first();
    //
    assertDatabaseHas(Contact::class, createdContact($contact));
});

it('validate the user input', function () {
    livewire(ContactResource\Pages\CreateContact::class)
        ->fillForm([
            'name' => null,
            'phone' => null,
            'email' => 'not an email at all',
            'is_active' => 'a bool really!',
        ])
        ->call('create')
        ->assertHasFormErrors([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'email',
            'is_active' => 'boolean',
        ]);
});

it('shows the edit view', function () {
    // Arrange
    get(ContactResource::getUrl('edit', [
        'record' => Contact::factory()->create(),
    ]))->assertSuccessful();
});

it('shows the data in the edit form', function () {
    // Arrange
    $contact = Contact::factory()->create();
    // Act and Assert
    livewire(ContactResource\Pages\EditContact::class, [
        'record' => $contact->getRouteKey(),
    ])
        ->assertFormSet(createdContact($contact));
});

it('can be soft deleted', function () {
    // Arrange
    $contact = Contact::factory()->create();

    // Act and Assert
    livewire(ContactResource\Pages\EditContact::class, [
        'record' => $contact->getRouteKey(),
    ])
        ->callAction(DeleteAction::class);

    assertSoftDeleted($contact);
});

todo('cannot be delete by unauthorized user');

function createdContact($contact): array
{
    return [
        'name' => $contact->name,
        'phone' => $contact->phone,
        'email' => $contact->email,
        'website' => $contact->website,
        'address_line_1' => $contact->address_line_1,
        'address_line_2' => null,
        'city_id' => $contact->city_id,
        'added_by' => $contact->added_by,
        'is_active' => $contact->is_active,
    ];
}
