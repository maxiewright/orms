<?php

namespace Modules\Legal\Filament\Resources\InterdicationResource\Pages;

use Modules\Legal\Filament\Resources\InterdictionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInterdication extends EditRecord
{
    protected static string $resource = InterdictionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
