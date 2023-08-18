<?php

namespace App\Filament\Resources\Metadata\InterviewStatusResource\Pages;

use App\Filament\Resources\Metadata\InterviewStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageInterviewStatuses extends ManageRecords
{
    protected static string $resource = InterviewStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
