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
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Modules\ServiceFund\App\Models\Contact;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\Enums\PaymentMethodEnum;
use Modules\ServiceFund\Enums\TransactionTypeEnum;

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
            TextColumn::make('categories.name'),
            TextColumn::make('transactional.name')
                ->label(function () use ($transactions) {
                    return match ($transactions->first()->type) {
                        TransactionTypeEnum::Debit => 'Paid By',
                        TransactionTypeEnum::Credit => 'Paid To',
                        TransactionTypeEnum::Transfer => 'Transferred By'
                    };
                }),
            TextColumn::make('approved_by')
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('approved_at')
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }


    public static function getTransactionForm(): array
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
                        ->options(PaymentMethodEnum::class)
                        ->required(),
                    TextInput::make('amount')
                        ->prefix(config('servicefund.currency'))
                        ->required()
                        ->numeric(),
                    Textarea::make('description')
                        ->columnSpanFull(),
                ]),
            Fieldset::make('Assign')
                ->columns(3)
                ->schema([
                    Select::make('transaction_category_id')
                        ->relationship('category', 'name')
                        ->required(),
                    MorphToSelect::make('transactional')
                        ->columnSpan(2)
                        ->label('Payer')
                        ->types([
                            MorphToSelect\Type::make(Contact::class)
                                ->titleAttribute('name'),
                            MorphToSelect\Type::make(app(config('servicefund.user.model'))::class)
                                //TODO - Find a way to not hardcode the Serviceperson class here
                                ->getOptionLabelFromRecordUsing(function (Serviceperson $record): string {
                                    return $record->military_name;
                                }),
                        ])
                        ->required()
                        ->searchable()
                        ->preload(),
                ]),
            Fieldset::make('Approval')
                ->columns(2)
                ->schema([
                    Select::make('approved_by')
                        ->relationship('approvedBy', 'name')
                        ->searchable(config('servicefund.user.search_columns'))

//                        ->getOptionLabelFromRecordUsing(fn (Serviceperson $serviceperson) => $serviceperson->military_name)
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
