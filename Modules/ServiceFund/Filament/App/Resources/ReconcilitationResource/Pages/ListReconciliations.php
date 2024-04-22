<?php

namespace Modules\ServiceFund\Filament\App\Resources\ReconcilitationResource\Pages;

use Modules\ServiceFund\Filament\App\Resources\ReconciliationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReconciliations extends ListRecords
{
    protected static string $resource = ReconciliationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
