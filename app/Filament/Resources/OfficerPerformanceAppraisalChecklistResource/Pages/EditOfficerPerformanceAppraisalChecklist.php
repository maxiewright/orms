<?php

namespace App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource\Pages;

use App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOfficerPerformanceAppraisalChecklist extends EditRecord
{
    protected static string $resource = OfficerPerformanceAppraisalChecklistResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
