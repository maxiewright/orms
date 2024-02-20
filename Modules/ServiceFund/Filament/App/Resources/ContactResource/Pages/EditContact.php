<?php

namespace Modules\ServiceFund\Filament\App\Resources\ContactResource\Pages;

use Modules\ServiceFund\Filament\App\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContact extends EditRecord
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
