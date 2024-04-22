<?php

namespace Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\ServiceFund\Filament\App\Resources\AccountResource;

class EditAccount extends EditRecord
{
    protected static string $resource = AccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['opening_balance_in_cents'] = $data['opening_balance_in_cents'] / 100;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['opening_balance_in_cents'] = $data['opening_balance_in_cents'] * 100;

        return $data;
    }
}
