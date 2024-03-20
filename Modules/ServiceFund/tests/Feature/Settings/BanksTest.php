<?php

namespace Modules\ServiceFund\tests\Feature\Metadata;

use Modules\ServiceFund\App\Models\Bank;
use Modules\ServiceFund\App\Models\BankBranch;
use Modules\ServiceFund\Filament\App\Resources\BankBranchResource;
use Modules\ServiceFund\Filament\App\Resources\BankBranchResource\Pages\ListBankBranches;
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

    $this->bank = Bank::factory()->create();
    $this->branch = BankBranch::factory()->create([
        'bank_id' => $this->bank->id,
    ]);
});

it('renders the bank branches page', function () {
    get(BankBranchResource::getUrl())
        ->assertSuccessful();
});

it('shows a list of bank branches', function () {
    $branches = BankBranch::factory()->count(5)->create();

    livewire(ListBankBranches::class)
        ->assertCanSeeTableRecords($branches);
});

it('creates a bank branch', function () {
    livewire(ListBankBranches::class)
        ->callAction('create', [
            'bank_id' => $this->bank->id,
            'email' => 'email@bank.com',
            'phone' => fake()->phoneNumber(),
            'address_line_1' => fake()->streetAddress(),
            'address_line_2' => null,
            'city_id' => app(config('servicefund.address.city'))::all()->random()->id,
        ])->assertHasNoActionErrors();

    assertDatabaseHas('bank_branches', [
        'bank_id' => $this->bank->id,
        'email' => 'email@bank.com',
    ]);
});

it('edits a bank branch', function () {
    livewire(ListBankBranches::class)
        ->callTableAction('edit', $this->branch, [
            'bank_id' => $this->bank->id,
            'email' => 'editedEmail@bank.com',
        ])
        ->assertHasNoActionErrors();

    assertDatabaseHas('bank_branches', [
        'bank_id' => $this->bank->id,
        'email' => 'editedEmail@bank.com',
    ]);

});

it('soft deletes a bank branch', function () {
    livewire(ListBankBranches::class)
        ->callTableAction('delete', $this->branch)
        ->assertHasNoActionErrors();

    assertSoftDeleted('bank_branches', [
        'bank_id' => $this->bank->id,
    ]);
});
