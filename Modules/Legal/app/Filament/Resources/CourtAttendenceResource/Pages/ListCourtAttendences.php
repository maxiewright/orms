<?php

namespace Modules\Legal\Filament\Resources\CourtAttendenceResource\Pages;

use Modules\Legal\Filament\Resources\CourtAttendenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourtAttendences extends ListRecords
{
    protected static string $resource = CourtAttendenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
