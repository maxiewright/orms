<?php

namespace App\Filament\Resources\Metadata\OfficerAppraisalGradeResource\Pages;

use App\Filament\Resources\Metadata\OfficerAppraisalGradeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOfficerAppraisalGrades extends ManageRecords
{
    protected static string $resource = OfficerAppraisalGradeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
