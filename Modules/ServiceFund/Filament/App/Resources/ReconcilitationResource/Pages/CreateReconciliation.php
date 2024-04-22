<?php

namespace Modules\ServiceFund\Filament\App\Resources\ReconcilitationResource\Pages;

use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Modules\ServiceFund\Filament\App\Resources\ReconciliationResource;

class CreateReconciliation extends CreateRecord
{
    protected static string $resource = ReconciliationResource::class;

    protected static bool $canCreateAnother = false;

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label(__('Reconcile'))
            ->submit('create')
            ->keyBindings(['mod+s'])
            ->disabled(fn () => $this->data['difference'] != 0);
    }

    protected function getRedirectUrl(): string
    {
        return ReconciliationResource::getUrl();
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['closing_balance_in_cents'] = $data['closing_balance_in_cents'] * 100;

        return $data;
    }

}
