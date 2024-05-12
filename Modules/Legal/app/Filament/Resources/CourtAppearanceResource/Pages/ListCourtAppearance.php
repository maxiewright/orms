<?php

namespace Modules\Legal\Filament\Resources\CourtAppearanceResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Legal\Filament\Resources\CourtAppearanceResource;

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
