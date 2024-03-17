<?php

namespace Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages;

use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Actions\CreateAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\ServiceFund\App\Actions\ProcessTransferAction;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\Enums\TransactionType;
use Modules\ServiceFund\Filament\App\Resources\AccountResource;

class AccountCreditTransfer extends Page implements HasForms, HasTable
{
    use HasPageSidebar;
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string $resource = AccountResource::class;

    protected static string $view = 'servicefund::filament.resources.account-resource.pages.account-debit-transfer';

    protected static ?string $title = 'Transfers';

    public Account $record;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('New Credit Transfer')
                ->mutateFormDataUsing(function (array $data): array {
                    $data['credit_account_id'] = $this->record->id;
                    $data['created_by'] = auth()->id();

                    return $data;
                })
                ->using(function (array $data): Model {

                    $transfer = (new ProcessTransferAction())($data);

                    return $transfer->creditTransaction;
                })
                ->successNotification(
                    Notification::make()->success()
                        ->title(fn (): string => 'Transfer Completed!')
                        ->body(fn (): string => 'The transfer was successful!')
                )
                ->model(Transaction::class)
                ->modelLabel('Credit Transfer')
                ->slideOver()
                ->form(Account::getTransactionForm(
                    record: $this->record,
                    transactionType: TransactionType::CreditTransfer
                )),
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
