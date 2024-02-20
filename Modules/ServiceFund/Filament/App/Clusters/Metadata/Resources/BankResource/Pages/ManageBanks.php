<?php

namespace Modules\ServiceFund\Filament\App\Clusters\Metadata\Resources\BankResource\Pages;

use Modules\ServiceFund\Filament\App\Clusters\Metadata\Resources\BankResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBanks extends ManageRecords
{
    protected static string $resource = BankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
