<?php

namespace App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource\Pages;

use App\Filament\Resources\OfficerPerformanceAppraisalChecklistResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOfficerPerformanceAppraisalChecklists extends ListRecords
{
    protected static string $resource = OfficerPerformanceAppraisalChecklistResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
