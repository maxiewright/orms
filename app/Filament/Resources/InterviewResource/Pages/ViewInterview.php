<?php

namespace App\Filament\Resources\InterviewResource\Pages;

use App\Filament\Resources\InterviewResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInterview extends ViewRecord
{
    protected static string $resource = InterviewResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
