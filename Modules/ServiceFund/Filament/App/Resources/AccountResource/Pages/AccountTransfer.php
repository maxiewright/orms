<?php

namespace Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\Filament\App\Resources\AccountResource;

class AccountTransfer extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string $resource = AccountResource::class;

    protected static string $view = 'modules.service-fund.filament.resources.account-resource.pages.account-transfer';

    public Account $record;

    public function table(Table $table): Table
    {
        return $table
            ->relationship(fn () => $this->record->transactions()->transfer())
            ->inverseRelationship('account')
            ->columns(Account::getTransactionTableColumns())
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
}