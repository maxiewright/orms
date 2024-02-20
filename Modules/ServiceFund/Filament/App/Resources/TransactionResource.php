<?php

namespace Modules\ServiceFund\Filament\App\Resources;

use App\Models\Serviceperson;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\ServiceFund\App\Models\Contact;
use Modules\ServiceFund\App\Models\Transaction;
use Modules\ServiceFund\App\Models\TransactionType;
use Modules\ServiceFund\Enums\PaymentMethodEnum;
use Modules\ServiceFund\Enums\TransactionTypeEnum;
use Modules\ServiceFund\Filament\App\Resources\TransactionResource\Pages;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationGroup = 'Banking';

    public static function getNavigationLabel(): string
    {
        return 'All Transactions';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Transaction')
                    ->columns(4)
                    ->schema([
                        Select::make('account_id')
                            ->relationship('account', 'name')
                            ->required(),
                        Select::make('type')
                            ->label('Transaction Type')
                            ->options(TransactionTypeEnum::class)
                            ->required(),
                        DateTimePicker::make('executed_at')
                            ->label('Transaction Date & Time')
                            ->format(config('servicefund.timestamp.datetime'))
                            ->required()
                            ->default(now())
                            ->seconds(false),
                        TextInput::make('amount')
                            ->prefix(config('servicefund.currency'))
                            ->required()
                            ->numeric(),
                        Textarea::make('description')
                            ->columnSpanFull(),
                    ]),
                Section::make('Payment')
                    ->columns(3)
                    ->schema([
                        Select::make('payment_method')
                            ->options(PaymentMethodEnum::class)
                            ->required(),
                        Select::make('transaction_category_id')
                            ->relationship('category', 'name')
                            ->required(),
                        MorphToSelect::make('transactional')
                            ->label('Vendor / Payee')
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

                Section::make('Approval')
                    ->columns(2)
                    ->schema([
                        Select::make('approved_by')
                            ->relationship('approvedBy', 'number')
//                            ->searchable(config('servicefund.user.search_columns'))
                            ->getOptionLabelFromRecordUsing(fn (Serviceperson $serviceperson) => $serviceperson->military_name)
                            ->required(),
                        DateTimePicker::make('approved_at')
                            ->label('Approval date and time')
                            ->required()
                            ->default(now())
                            ->seconds(false),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('account.name'),
                Tables\Columns\TextColumn::make('transaction_type_id')
                    ->label('Type')
                    ->badge(),
                Tables\Columns\TextColumn::make('executed_at')
                    ->label('Transaction Date')
                    ->date(config('servicefund.timestamp.date')),
                Tables\Columns\TextColumn::make('amount')
                    ->money(config('servicefund.currency')),
                Tables\Columns\TextColumn::make('paymentMethod.name'),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('transactional.name')
                    ->label('Payee / Vendor'),
                Tables\Columns\TextColumn::make('approvedBy.military_name'),
                Tables\Columns\TextColumn::make('approved_at')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Transaction Date')
                    ->date(config('servicefund.timestamp.date')),
                Tables\Columns\TextColumn::make('createdBy.name')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
