<?php

namespace Modules\ServiceFund\Traits;

use App\Models\Serviceperson;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Contact;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\App\Models\TransactionCategory;
use Modules\ServiceFund\Enums\PaymentMethod;
use Modules\ServiceFund\Enums\TransactionType;

trait InteractsWithTransactions
{
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Str::ucwords($value),
            set: fn ($value) => Str::lower($value),
        );
    }

    public static function getTransactionTableColumns($transactions): array
    {
        return [
            TextColumn::make('executed_at'),
            TextColumn::make('amount')
                ->money(config('servicefund.currency')),
            TextColumn::make('payment_method'),
            TextColumn::make('categories.name')
                ->badge()
                ->label('Category')
                ->placeholder('No Category'),
            TextColumn::make('transactional.name')
                ->label(function () use ($transactions) {
                    return match ($transactions->first()->type) {
                        TransactionType::Debit => 'Paid By',
                        TransactionType::Credit => 'Paid To',
                        TransactionType::DebitTransfer,
                        TransactionType::CreditTransfer => 'Transferred By',
                    };
                }),
            TextColumn::make('debitTransfers.creditAccount.name')
                ->hidden(fn () => $transactions?->first()?->type !== TransactionType::DebitTransfer)
                ->label('Transferred From')
                ->icon('heroicon-o-currency-dollar')
                ->description('click to view account')
                ->url(function ($record) {

                    $account = $record->load('debitTransfers.creditAccount')
                        ->debitTransfers->first()?->creditAccount;

                    return $account
                        ? route('filament.service-fund.resources.accounts.dashboard', ['record' => $account->slug])
                        : '';
                }),
            TextColumn::make('creditTransfers.debitAccount.name')
                ->hidden(fn () => $transactions?->first()?->type !== TransactionType::CreditTransfer)
                ->label('Transferred To')
                ->icon('heroicon-o-currency-dollar')
                ->description('click to view account')
                ->url(function ($record) {
                    $account = $record->load('debitTransfers.creditAccount')
                        ->creditTransfers->first()?->debitAccount;

                    return $account
                        ? route('filament.service-fund.resources.accounts.dashboard', ['record' => $account])
                        : '';
                }),
            TextColumn::make('approved_by')
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('approved_at')
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    public static function getTransactionTableFilters(): array
    {
        return [
            SelectFilter::make('payment_method')
                ->options(PaymentMethod::class)
                ->multiple(),
        ];
    }

    public static function getTransactionForm($record, $transactionType = TransactionType::Debit): array
    {
        return [

            Fieldset::make('General')
                ->columns(3)
                ->schema([
                    Select::make('credit_account_id')
                        ->label('Transfer From')
                        ->options(fn () => Account::pluck('name', 'id')->except($record->id))
                        ->searchable()
                        ->required()
                        ->hidden(fn () => $transactionType !== TransactionType::DebitTransfer),
                    Select::make('debit_account_id')
                        ->label('Transfer To')
                        ->options(fn () => Account::pluck('name', 'id')->except($record->id))
                        ->searchable()
                        ->required()
                        ->hidden(fn () => $transactionType !== TransactionType::CreditTransfer),
                    DateTimePicker::make('executed_at')
                        ->label('Date & Time')
                        ->required()
                        ->default(now())
                        ->seconds(false),
                    Select::make('payment_method')
                        ->enum(PaymentMethod::class)
                        ->options(PaymentMethod::class)
                        ->required(),
                    TextInput::make('amount_in_cents')
                        ->label('Amount')
                        ->prefix(config('servicefund.currency'))
                        ->required()
                        ->numeric(),
                    Textarea::make('description')
                        ->columnSpanFull(),
                ]),
            Fieldset::make('Assign')
                ->columns()
                ->schema([
                    MorphToSelect::make('transactional')
                        ->label(fn () => $transactionType === TransactionType::Debit ? 'Payer' : 'Payee')
                        ->types([
                            MorphToSelect\Type::make(app(config('servicefund.user.model'))::class)
                                //TODO - Find a way to not hardcode the Serviceperson class here
                                ->getOptionLabelFromRecordUsing(function (Serviceperson $serviceperson): string {
                                    return $serviceperson->military_name;
                                }),
                            MorphToSelect\Type::make(Contact::class)
                                ->titleAttribute('name'),
                        ])
                        ->required()
                        ->searchable()
                        ->preload(),
                    Select::make('categories')
                        ->helperText('If the category you are looking for is not available, click the plus icon to create it.')
                        ->relationship(name: 'categories', titleAttribute: 'name')
                        ->dehydrated()
                        ->multiple()
                        ->preload()
                        ->createOptionForm(TransactionCategory::getForm()),
                ]),
            Fieldset::make('Approval')
                ->hidden(fn () => $transactionType !== TransactionType::Credit)
                ->columns(2)
                ->schema([
                    Select::make('approved_by')
                        ->relationship('approvedBy', 'number')
                        ->searchable(config('servicefund.user.search_columns'))
                        ->getOptionLabelFromRecordUsing(fn (Serviceperson $serviceperson) => $serviceperson->military_name)
                        ->required(),
                    DateTimePicker::make('approved_at')
                        ->label('Approval date and time')
                        ->required()
                        ->default(now())
                        ->seconds(false),
                ]),
        ];
    }
}
