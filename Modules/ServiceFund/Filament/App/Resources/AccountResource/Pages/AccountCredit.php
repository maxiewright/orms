<?php

namespace Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages;

use App\Models\Serviceperson;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Contact;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\Enums\PaymentMethodEnum;
use Modules\ServiceFund\Enums\TransactionTypeEnum;
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
                    $data['type'] = TransactionTypeEnum::Credit;

                    return $data;
                })
                ->label('New Credit')
                ->model(Transaction::class)
                ->modelLabel('Credit')
                ->slideOver()
                ->form([]),
        ];

    }

    public function table(Table $table): Table
    {

        $transactions = $this->record->transactions()->credit();

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
                // ...
            ]);
    }
}
