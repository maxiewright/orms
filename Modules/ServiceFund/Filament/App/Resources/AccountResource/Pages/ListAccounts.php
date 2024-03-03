<?php

namespace Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages;

use Modules\ServiceFund\Filament\App\Resources\AccountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccounts extends ListRecords
{
    protected static string $resource = AccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Create Account'),
        ];
    }
}
