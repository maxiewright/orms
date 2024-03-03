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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\ServiceFund\App\Actions\ProcessTransactionAction;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\Enums\PaymentMethod;
use Modules\ServiceFund\Enums\TransactionType;
use Modules\ServiceFund\Filament\App\Resources\AccountResource;

class AccountCredit extends Page implements HasForms, HasTable
{
    use HasPageSidebar;
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string $resource = AccountResource::class;

    protected static string $view = 'servicefund::filament.resources.account-resource.pages.account-credit';

    protected static ?string $title = 'Credits';

    public Account $record;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    $data['account_id'] = $this->record->id;
                    $data['type'] = TransactionType::Credit;
                    $data['created_by'] = auth()->id();

                    return $data;
                })
                ->using(function (array $data): Model {

                    $processTransaction = new ProcessTransactionAction();

                    return $processTransaction($data);
                })
                ->successNotification(
                    Notification::make()->success()
                        ->title(fn (): string => "{$this->record->name} credited!")
                        ->body(fn (): string => "The {$this->record->name} account has been credited successfully!")
                )
                ->model(Transaction::class)
                ->modelLabel('Credit')
                ->slideOver()
                ->form(Account::getTransactionForm(transactionType: TransactionType::Credit)),
        ];

    }

    public function table(Table $table): Table
    {

        $transactions = $this->record->transactions()->credit();

        return $table
            ->relationship(fn () => $transactions)
            ->inverseRelationship('account')
            ->columns(Account::getTransactionTableColumns($transactions))
            ->filters(Account::getTransactionTableFilters())
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
