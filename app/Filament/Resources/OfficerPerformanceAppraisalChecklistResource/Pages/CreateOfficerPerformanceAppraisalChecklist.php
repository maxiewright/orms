<?php

namespace App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource\Pages;

use App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOfficerPerformanceAppraisalChecklist extends CreateRecord
{
    protected static string $resource = OfficerPerformanceAppraisalChecklistResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
