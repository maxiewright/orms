<?php

namespace App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource\Pages;

use App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource;
use App\Filament\Traits\RedirectToIndex;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOfficerPerformanceAppraisalChecklist extends EditRecord
{
    use RedirectToIndex;

    protected static string $resource = OfficerPerformanceAppraisalChecklistResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

}
