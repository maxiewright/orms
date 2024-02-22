<?php

namespace Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages;

use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Actions\CreateAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\Enums\TransactionTypeEnum;
use Modules\ServiceFund\Filament\App\Resources\AccountResource;

class AccountDebit extends Page implements HasForms, HasTable
{
    use HasPageSidebar;
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string $resource = AccountResource::class;

    protected static string $view = 'servicefund::filament.resources.account-resource.pages.account-debit';

    protected static ?string $title = 'Debits';

    public Account $record;

    public function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    $data['account_id'] = $this->record->id;
                    $data['type'] = TransactionTypeEnum::Debit;
                    $data['created_by'] = auth()->id();

                    return $data;
                })
                ->model(Transaction::class)
                ->modelLabel('Debit')
                ->slideOver()
                ->form(Account::getTransactionForm()),
        ];
    }

    public function table(Table $table): Table
    {

        $transactions = $this->record->transactions()->debit();

        return $table
            ->relationship(fn () => $transactions)
            ->inverseRelationship('account')
            ->columns(Account::getTransactionTableColumns($transactions))
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ..
            ]);
    }
}
