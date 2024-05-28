<?php

namespace Modules\Legal\Filament\Resources\LitigationResource\Pages;

use Modules\Legal\Filament\Resources\LitigationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLitigation extends EditRecord
{
    protected static string $resource = LitigationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
