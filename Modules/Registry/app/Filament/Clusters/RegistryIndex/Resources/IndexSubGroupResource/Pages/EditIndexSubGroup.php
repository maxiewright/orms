<?php

namespace Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexSubGroupResource\Pages;

use Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexSubGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIndexSubGroup extends EditRecord
{
    protected static string $resource = IndexSubGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
