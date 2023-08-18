<?php

namespace App\Filament\Resources\Metadata\EnlistmentTypeResource\Pages;

use App\Filament\Resources\Metadata\EnlistmentTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEnlistmentTypes extends ManageRecords
{
    protected static string $resource = EnlistmentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
