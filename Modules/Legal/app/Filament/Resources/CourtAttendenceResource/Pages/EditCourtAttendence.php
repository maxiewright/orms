<?php

namespace Modules\Legal\Filament\Resources\CourtAttendenceResource\Pages;

use Modules\Legal\Filament\Resources\CourtAttendenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCourtAttendence extends EditRecord
{
    protected static string $resource = CourtAttendenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
