<?php


use App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource as AppraisalChecklistResource;
use App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource\{
    Pages\ListOfficerPerformanceAppraisalChecklists,
};
use App\Models\OfficerPerformanceAppraisalChecklist;
use Illuminate\Support\Collection;
use function Pest\Livewire\livewire;

function createAppraisalChecklists($count): OfficerPerformanceAppraisalChecklist|Collection
{
    return OfficerPerformanceAppraisalChecklist::factory()
        ->count($count)
        ->create();
}

it('it can access the appraisal checklist resource', function () {
    // Act & Assert
    logInAsUserWithRole()
        ->get(AppraisalChecklistResource::getUrl())
        ->assertSuccessful();
});

it('it shows appraisal checklist list', function () {
    // Arrange
    $appraisals = createAppraisalChecklists(count: 10);

    // Act & Assert
    logInAsUserWithRole();
    livewire(ListOfficerPerformanceAppraisalChecklists::class)
        ->assertCanSeeTableRecords($appraisals);
});


