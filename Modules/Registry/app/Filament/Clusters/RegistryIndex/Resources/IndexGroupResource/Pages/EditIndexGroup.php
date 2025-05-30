<?php

namespace Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexGroupResource\Pages;

use Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIndexGroup extends EditRecord
{
    protected static string $resource = IndexGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
