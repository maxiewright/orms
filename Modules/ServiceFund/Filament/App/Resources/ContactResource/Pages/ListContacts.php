<?php

namespace Modules\ServiceFund\Filament\App\Resources\ContactResource\Pages;

use Modules\ServiceFund\Filament\App\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}