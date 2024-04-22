<?php

namespace Modules\ServiceFund\Filament\App\Resources\ReconcilitationResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\ServiceFund\Filament\App\Resources\ReconciliationResource;

class EditReconciliation extends EditRecord
{
    protected static string $resource = ReconciliationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): ?string
    {
        return ReconciliationResource::getUrl();
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['closing_balance_in_cents'] = $data['closing_balance_in_cents'] / 100;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {

        $data['closing_balance_in_cents'] = $data['closing_balance_in_cents'] * 100;

        return $data;
    }
}
