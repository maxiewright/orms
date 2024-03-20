<?php

namespace Modules\ServiceFund\Filament\App\Resources\BankBranchResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\ServiceFund\App\Models\BankBranch;
use Modules\ServiceFund\Filament\App\Resources\BankBranchResource;

class ListBankBranches extends ListRecords
{
    protected static string $resource = BankBranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->form(BankBranch::getForm())
                ->slideOver(),
        ];
    }
}
