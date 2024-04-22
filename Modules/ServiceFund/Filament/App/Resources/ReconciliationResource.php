<?php

namespace Modules\ServiceFund\Filament\App\Resources;

use App\Models\Serviceperson;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Modules\ServiceFund\App\Actions\ProcessReconciliationTransactionsAction;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Contact;
use Modules\ServiceFund\App\Models\Reconciliation;
use Modules\ServiceFund\Enums\PaymentMethod;
use Modules\ServiceFund\Enums\TransactionType;
use Modules\ServiceFund\Filament\App\Resources\ReconcilitationResource\Pages;

class ReconciliationResource extends Resource
{
    protected static ?string $model = Reconciliation::class;

    protected static ?string $navigationGroup = 'Banking';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Group::make([
                    Select::make('account_id')
                        ->live()
//                        ->rules([
//                            Rule::unique('reconciliations')->where(fn ($query, Get $get) => $query
//                                ->where('account_id', $get('account_id'))
//                                ->where('started_at', '>=', $get('started_at'))
//                                ->where('ended_at', '<=', $get('ended_at'))),
//                        ])

                        ->afterStateUpdated(function (Get $get, Set $set, $state) {
                            if ($state) {
                                $set('transactions', self::getTransactions(
                                    accountId: $state,
                                    startDate: $get('started_at'),
                                    endDate: $get('ended_at'))
                                );

                                $set('opening_balance', Account::find($state)
                                    ->balanceAt(Carbon::make($get('started_at'))));

                                $set('closing_balance_in_cents', Account::find($state)->balance);

                                self::updateCalculations($get, $set);
                            }
                        })
                        ->relationship('account', 'name')
                        ->required()
                        ->searchable()
                        ->preload(),
                    DatePicker::make('started_at')
                        ->default(now()->startOfMonth()->subMonthNoOverflow())
                        ->label('Statement Start Date')
                        ->before('ended_at')
                        ->required()
                        ->live()
                        ->afterStateUpdated(function (Get $get, Set $set, $state) {
                            if ($get('account_id')) {
                                $set('transactions', self::getTransactions(
                                    accountId: $get('account_id'),
                                    startDate: $state,
                                    endDate: $get('ended_at'))
                                );
                            }
                        }),
                    DatePicker::make('ended_at')
                        ->default(now()->subMonthNoOverflow()->endOfMonth())
                        ->label('Statement End Date')
                        ->after('started_at')
                        ->required()
                        ->live()
                        ->afterStateUpdated(function (Get $get, Set $set, $state) {
                            if ($get('account_id')) {
                                $set('transactions', self::getTransactions(
                                    accountId: $get('account_id'),
                                    startDate: $get('started_at'),
                                    endDate: $state)
                                );
                            }
                        }),

                    TextInput::make('closing_balance_in_cents')
                        ->helperText('Adjust closing balance per statement')
                        ->currencyMask()
                        ->numeric()
                        ->debounce()
                        ->prefix(config('servicefund.currency'))
                        ->placeholder('0.00')
                        ->label('Closing Balance')
                        ->required()
                        ->afterStateUpdated(function (Get $get, Set $set) {
                            self::updateCalculations($get, $set);
                        }),

                ])
                    ->columns(4)
                    ->columnSpanFull(),

                TableRepeater::make('transactions')
                    ->addActionLabel('Add Transaction')
                    ->relationship()
                    ->streamlined()
                    ->headers([
                        Header::make('Date')
                            ->markAsRequired()
                            ->align(Alignment::Center)
                            ->width('100px'),
                        Header::make('Payment Method')
                            ->markAsRequired()
                            ->align(Alignment::Center),
                        Header::make('Payee / Vendor')
                            ->markAsRequired()
                            ->align(Alignment::Center),
                        Header::make('Type')
                            ->markAsRequired()
                            ->align(Alignment::Center),
                        Header::make('Amount')
                            ->markAsRequired()
                            ->align(Alignment::Center)
                            ->width('175px'),
                        Header::make('Clear')
                            ->align(Alignment::Center)
                            ->markAsRequired(),
                    ])
                    ->schema([
                        Hidden::make('account_id'),
                        DatePicker::make('execution_date')
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('executed_at', $state);
                            })
                            ->required()
                            ->dehydrated(false)
                            ->default(now()),
                        Hidden::make('executed_at'),
                        Select::make('payment_method')
                            ->options(PaymentMethod::class)
                            ->required(),
                        MorphToSelect::make('transactional')
                            ->extraAttributes(['class' => 'gap-0'])
                            ->types([
                                MorphToSelect\Type::make(Contact::class)
                                    ->titleAttribute('name'),
                                MorphToSelect\Type::make(app(config('servicefund.user.model'))::class)
                                    //TODO - Find a way to not hardcode the Serviceperson class here
                                    ->titleAttribute('number')
                                    ->searchColumns(['number', 'first_name', 'last_name'])
                                    ->getOptionLabelFromRecordUsing(function (Serviceperson $record): string {
                                        return $record->military_name;
                                    }),
                            ])
                            ->columns()
                            ->view('servicefund::filament.input.table-repeater.morph-to-select')
                            ->required()
                            ->searchable(),

                        Select::make('type')
                            ->extraInputAttributes(fn (Get $get) => self::setColor($get))
                            ->options(TransactionType::class)
                            ->enum(TransactionType::class)
                            ->required(),
                        TextInput::make('amount')
                            ->afterStateUpdated(fn (Set $set, $state) => $set('amount_in_cents', $state * 100))
                            ->extraInputAttributes(fn (Get $get) => self::setColor($get))
                            ->prefix(config('servicefund.currency'))
                            ->placeholder('0.00')
                            ->label('Amount')
                            ->currencyMask()
                            ->required()
                            ->debounce()
                            ->live(),

                        Hidden::make('amount_in_cents'),

                        Checkbox::make('reconciled')
                            ->view('servicefund::filament.input.table-repeater.checkbox')
                            ->inline(false)
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                self::updateCalculations($get, $set, inRepeater: true);
                            }),
                    ])->saveRelationshipsUsing(function ($record, $state, ProcessReconciliationTransactionsAction $processReconciliationTransactions) {
                        $processReconciliationTransactions->handle(
                            reconciliation: $record,
                            transactions: $state
                        );
                    })
                    ->columnSpan('full'),

                Group::make([
                    TextInput::make('opening_balance')
                        ->currencyMask()
                        ->live()
                        ->prefix(config('servicefund.currency'))
                        ->label('Opening Balance')
                        ->placeholder('0.00')
                        ->numeric()
                        ->readOnly(),
                    TextInput::make('closing_balance')
                        ->live()
                        ->prefix(config('servicefund.currency'))
                        ->placeholder('0.00')
                        ->label('Closing Balance')
                        ->currencyMask()
                        ->numeric()
                        ->readOnly(),
                    TextInput::make('cleared_transactions')
                        ->prefix(config('servicefund.currency'))
                        ->currencyMask()
                        ->label('Cleared Transactions')
                        ->placeholder('0.00')
                        ->numeric()
                        ->readOnly(),
                    TextInput::make('difference')
                        ->prefix(config('servicefund.currency'))
                        ->currencyMask()
                        ->label('Difference')
                        ->placeholder('0.00')
                        ->numeric()
                        ->readOnly(), //TODO - Add a validation rule to ensure that the difference is 0,
                ])
                    ->columns(4)
                    ->columnSpanFull(),

            ]);
    }

    private static function getTransactions($accountId, $startDate, $endDate): array
    {
        //        dd(Account::find($accountId)->transactionsBetween($startDate, $endDate)->toArray());
        return $accountId
            ? Account::find($accountId)
                ->transactionsBetween($startDate, $endDate)
                ->toArray()
            : [];
    }

    public static function getCredits(Get $get, string $prefix): float
    {
        return collect($get($prefix.'transactions'))
            ->filter(function ($item) {
                return $item['reconciled'] == true
                    && ($item['type'] === TransactionType::Credit->value
                        || $item['type'] === TransactionType::CreditTransfer->value);
            })->sum('amount');
    }

    public static function getDebits(Get $get, string $prefix): float
    {
        return collect($get($prefix.'transactions'))
            ->filter(function ($item) {
                return $item['reconciled'] == true
                    && ($item['type'] === TransactionType::Debit->value
                        || $item['type'] === TransactionType::DebitTransfer->value);
            })->sum('amount');
    }

    private static function getAccountBalance($accountId)
    {
        return $accountId
            ? Account::find($accountId)->balance
            : 0;
    }

    public static function updateCalculations(Get $get, Set $set, $inRepeater = false): void
    {
        $inRepeater ? $prefix = '../../' : $prefix = '';

        $debits = self::getDebits($get, $prefix);

        $credits = self::getCredits($get, $prefix);

        $cleared_amount = (float) $get($prefix.'opening_balance') + ($debits - $credits);

        $difference = (float) $get($prefix.'closing_balance_in_cents') - $cleared_amount;

        $set($prefix.'closing_balance', (float) $get($prefix.'closing_balance_in_cents'));

        $set($prefix.'cleared_transactions', $cleared_amount);

        $set($prefix.'difference', $difference);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('account.name')
                    ->label('Account')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('started_at')
                    ->date(config('servicefund.date_format'))
                    ->label('Start Date')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ended_at')
                    ->date(config('servicefund.date_format'))
                    ->label('End Date')
                    ->sortable(),
                Tables\Columns\TextColumn::make('closing_balance')
                    ->money(config('servicefund.currency')),
                Tables\Columns\TextColumn::make('transactions_count')
                    ->label('Reconciled Transactions')
                    ->counts('transactions')
                    ->alignCenter()
                    ->badge(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('account_id')
                    ->relationship('account', 'name')
                    ->label('Account')
                    ->searchable(),
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
            'index' => Pages\ListReconciliations::route('/'),
            'create' => Pages\CreateReconciliation::route('/create'),
            'edit' => Pages\EditReconciliation::route('/{record}/edit'),
        ];
    }

    /**
     * @return string[]
     */
    public static function setColor(Get $get): array
    {
        $type = $get('type');

        if ($type === TransactionType::Debit->value || $type === TransactionType::DebitTransfer->value) {
            return ['style' => 'color: green;'];
        }

        if ($type === TransactionType::Credit->value || $type === TransactionType::CreditTransfer->value) {
            return ['style' => 'color: red;'];
        }

        return [];
    }
}
