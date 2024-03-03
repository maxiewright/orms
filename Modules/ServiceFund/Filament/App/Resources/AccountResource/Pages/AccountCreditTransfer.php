<?php

namespace Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages;

use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\Filament\App\Resources\AccountResource;

class AccountCreditTransfer extends Page implements HasForms, HasTable
{
    use HasPageSidebar;
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string $resource = AccountResource::class;

    protected static string $view = 'servicefund::filament.resources.account-resource.pages.account-credit-transfer';

    protected static ?string $title = 'Transfers';

    public Account $record;

    protected function getHeaderActions(): array
    {

        return [
            Action::make('New Transfer')
                ->form([

                ]),
        ];
    }

    public function table(Table $table): Table
    {
        $transactions = $this->record->transactions()->creditTransfer();

        return $table
            ->relationship(fn () => $transactions)
            ->inverseRelationship('account')
            ->columns(Account::getTransactionTableColumns($transactions))
            ->filters([
                // ...
            ])
            ->actions([

            ])
            ->bulkActions([
                // ...
            ]);
    }
}
