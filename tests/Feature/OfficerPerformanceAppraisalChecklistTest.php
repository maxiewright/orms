<?php

use App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource\Pages\ListOfficerPerformanceAppraisalChecklists;
use function Pest\Livewire\livewire;


it('can render checklists', function () {

    livewire(ListOfficerPerformanceAppraisalChecklists::class)
        ->assertSuccessful();
});