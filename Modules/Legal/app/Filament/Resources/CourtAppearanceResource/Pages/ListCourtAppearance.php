<?php

namespace Modules\Legal\Filament\Resources\CourtAttendenceResource\Pages;

use Modules\Legal\Filament\Resources\CourtAppearanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourtAppearance extends ListRecords
{
    protected static string $resource = CourtAppearanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
