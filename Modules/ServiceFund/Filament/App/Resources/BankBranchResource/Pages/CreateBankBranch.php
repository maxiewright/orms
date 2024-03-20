<?php

namespace Modules\ServiceFund\Filament\App\Resources\BankBranchResource\Pages;

use Modules\ServiceFund\Filament\App\Resources\BankBranchResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBankBranch extends CreateRecord
{
    protected static string $resource = BankBranchResource::class;
}
