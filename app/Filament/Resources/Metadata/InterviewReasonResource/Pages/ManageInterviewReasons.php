<?php

namespace App\Filament\Resources\Metadata\InterviewReasonResource\Pages;

use App\Filament\Resources\Metadata\InterviewReasonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageInterviewReasons extends ManageRecords
{
    protected static string $resource = InterviewReasonResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
