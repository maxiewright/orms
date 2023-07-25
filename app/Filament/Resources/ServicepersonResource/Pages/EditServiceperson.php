<?php

namespace App\Filament\Resources\ServicepersonResource\Pages;

use App\Filament\Resources\ServicepersonResource;
use App\Filament\Traits\RedirectToIndex;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceperson extends EditRecord
{
    use RedirectToIndex;

    protected static string $resource = ServicepersonResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
