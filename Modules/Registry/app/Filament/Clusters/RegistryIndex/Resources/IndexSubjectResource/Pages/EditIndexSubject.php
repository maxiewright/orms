<?php

namespace Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexSubjectResource\Pages;

use Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexSubjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIndexSubject extends EditRecord
{
    protected static string $resource = IndexSubjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
