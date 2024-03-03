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
                ->label('Category'),
            TextColumn::make('transactional.name')
                ->label(function () use ($transactions) {
                    return match ($transactions->first()->type) {
                        TransactionType::Debit => 'Paid By',
                        TransactionType::Credit => 'Paid To',
                        TransactionType::CreditTransfer,
                        TransactionType::DebitTransfer => 'Transferred By'
                    };
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

    public static function getTransactionForm($transactionType = TransactionType::Debit): array
    {
        return [
            Fieldset::make('General')
                ->columns(3)
                ->schema([
                    DateTimePicker::make('executed_at')
                        ->label('Date & Time')
                        ->required()
                        ->default(now())
                        ->seconds(false),
                    Select::make('payment_method')
                        ->enum(PaymentMethod::class)
                        ->options(PaymentMethod::class)
                        ->required(),
                    TextInput::make('amount')
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
                                ->getOptionLabelFromRecordUsing(function (Serviceperson $record): string {
                                    return $record->military_name;
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
