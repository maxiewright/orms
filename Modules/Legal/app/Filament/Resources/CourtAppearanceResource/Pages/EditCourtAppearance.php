<?php

namespace Modules\Legal\Filament\Resources\CourtAppearanceResource\Pages;

use Modules\Legal\Filament\Resources\CourtAppearanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCourtAppearance extends EditRecord
{
    protected static string $resource = CourtAppearanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
