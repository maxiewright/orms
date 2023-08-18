<?php

namespace App\Filament\Resources\ServicepersonResource\Pages;

use App\Filament\Resources\ServicepersonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServicepeople extends ListRecords
{
    protected static string $resource = ServicepersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
