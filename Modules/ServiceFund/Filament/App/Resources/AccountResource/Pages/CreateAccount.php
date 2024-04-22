<?php

namespace Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\ServiceFund\Filament\App\Resources\AccountResource;

class CreateAccount extends CreateRecord
{
    protected static string $resource = AccountResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['is active']) {
            $data['active_at'] = now();
        }

        $data['opening_balance_in_cents'] = $data['opening_balance_in_cents'] * 100;

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
