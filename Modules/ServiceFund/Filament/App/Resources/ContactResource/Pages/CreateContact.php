<?php

namespace Modules\ServiceFund\Filament\App\Resources\ContactResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\ServiceFund\Filament\App\Resources\ContactResource;

class CreateContact extends CreateRecord
{
    protected static string $resource = ContactResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['added_by'] = auth()->id();

        return $data;

    }
}
