<?php

namespace Modules\ServiceFund\Filament\App\Resources\BankBranchResource\Pages;

use Modules\ServiceFund\Filament\App\Resources\BankBranchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBankBranch extends EditRecord
{
    protected static string $resource = BankBranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
