<?php

namespace Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages;

use Modules\ServiceFund\Filament\App\Resources\AccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccount extends EditRecord
{
    protected static string $resource = AccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
