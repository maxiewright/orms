<?php

namespace Modules\ServiceFund\Filament\App\Resources;

use App\Models\Serviceperson;
use AymanAlhattami\FilamentPageWithSidebar\FilamentPageSidebar;
use AymanAlhattami\FilamentPageWithSidebar\PageNavigationItem;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\Bank;
use Modules\ServiceFund\Enums\AccountType;
use Modules\ServiceFund\Filament\App\Resources\AccountResource\Pages;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static ?string $navigationGroup = 'Banking';

    public static function sidebar(Model $record): FilamentPageSidebar
    {
        return FilamentPageSidebar::make()
            ->setTitle($record->name)
            ->topbarNavigation()
            ->setNavigationItems([
                PageNavigationItem::make('Dashboard')
                    ->url(function () use ($record) {
                        return static::getUrl('dashboard', ['record' => $record]);
                    })
                    ->isActiveWhen(function () use ($record) {
                        return request()->routeIs('filament.service-fund.resources.accounts.dashboard', $record);
                    })
                    ->icon('heroicon-o-home'),
                PageNavigationItem::make('Debits')
                    ->url(function () use ($record) {
                        return static::getUrl('debits', ['record' => $record]);
                    })
                    ->isActiveWhen(function () use ($record) {
                        return request()->routeIs('filament.service-fund.resources.accounts.debits', $record);
                    })
                    ->icon('heroicon-o-user-group')
                    ->badge(function () use ($record) {
                        return $record->transactions()->debit()->count();
                    }),
                PageNavigationItem::make('Credits')
                    ->url(function () use ($record) {
                        return static::getUrl('credits', ['record' => $record]);
                    })
                    ->isActiveWhen(function () use ($record) {
                        return request()->routeIs('filament.service-fund.resources.accounts.credits', $record);
                    })
                    ->icon('heroicon-o-shopping-cart')
                    ->badge(function () use ($record) {
                        return $record->transactions()->credit()->count();
                    }),
                PageNavigationItem::make('Debit Transfers')
                    ->url(function () use ($record) {
                        return static::getUrl('debit-transfers', ['record' => $record]);
                    })
                    ->isActiveWhen(function () use ($record) {
                        return request()->routeIs('filament.service-fund.resources.accounts.debit-transfers', $record);
                    })
                    ->icon('heroicon-o-ticket')
                    ->badge(function () use ($record) {
                        return $record->transactions()->debitTransfer()->count();
                    }),
                PageNavigationItem::make('Credit Transfers')
                    ->url(function () use ($record) {
                        return static::getUrl('credit-transfers', ['record' => $record]);
                    })
                    ->isActiveWhen(function () use ($record) {
                        return request()->routeIs('filament.service-fund.resources.accounts.credit-transfers', $record);
                    })
                    ->icon('heroicon-o-ticket')
                    ->badge(function () use ($record) {
                        return $record->transactions()->creditTransfer()->count();
                    }),
            ]);
    }

    public static function form(Form $form): Form
    {
        /*
         *  TODO - If account type is cash generate an account number based on the amount of cash
         *         accounts that the company already has
         */

        return $form
            ->schema([

                Section::make('Service Info')
                    ->schema([
                        Select::make('company_id')
                            ->helperText('Select the company that this account belongs to')
                            ->relationship(Account::getCompanyName(), Account::getCompanyTitleAttribute())
                            ->label('Company')
                            ->required(),
                        Checkbox::make('is active')
                            ->label('Is this account active?')
                            ->default(true)
                            ->nullable(),
                    ]),
                Section::make('Account Info')
                    ->columns(3)
                    ->schema([
                        Select::make('type')
                            ->options(AccountType::class)
                            ->required()
                            ->live(),
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('number')
                            ->required(),
                        Select::make('bank_id')
                            ->columnSpan(2)
                            ->helperText('If the bank does not exist add one by click the plus icon')
                            ->relationship('bank', 'name')
                            ->getOptionLabelFromRecordUsing(fn (Bank $bank) => $bank->name)
                            ->label('Bank')
                            ->searchable()
                            ->preload()
                            ->createOptionForm(Bank::getForm())
                            ->required(),
                        TextInput::make('opening_balance')
                            ->required()
                            ->numeric(),
                    ]),
                Section::make('Signatories')
                    ->columns(6)
                    ->schema([
                        TextInput::make('minimum_signatories')
                            ->afterStateUpdated(function (TextInput $component, Set $set, Get $get, $state) {
                                if ($get('maximum_signatories') < $state) {
                                    $set('maximum_signatories', $state);
                                }
                            })
                            ->required()
                            ->lte('maximum_signatories')
                            ->numeric()
                            ->default(1)
                            ->live(),
                        TextInput::make('maximum_signatories')
                            ->afterStateUpdated(function (TextInput $component, Get $get, Set $set, $state) {
                                if ($get('minimum_signatories') > $state) {
                                    $set('minimum_signatories', $state);
                                }
                            })
                            ->required()
                            ->gte('minimum_signatories')
                            ->numeric()
                            ->default(1)
                            ->live(),
                        Select::make('signatories')
                            ->columnSpan(4)
                            ->label('Signatories / Custodians')
                            ->helperText('Start typing to search for the signatory(ies) or custodian(s) of the account ')
                            ->relationship('signatories', 'number')
                            ->searchable(['number', 'first_name', 'middle_name', 'last_name'])
                            ->optionsLimit(10)
                            ->getOptionLabelFromRecordUsing(function (Serviceperson $serviceperson) {
                                return $serviceperson->military_name;
                            })
                            ->multiple()
                            ->required()
                            ->afterStateUpdated(function (Select $component, Get $get) {
                                $component
                                    ->minItems($get('minimum_signatories'))
                                    ->maxItems($get('maximum_signatories'));
                            }),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(fn (Model $record) => static::getUrl('dashboard', ['record' => $record]))
            ->columns([
                Tables\Columns\TextColumn::make('company.name'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('number'),
                Tables\Columns\TextColumn::make('bank.name'),
                Tables\Columns\TextColumn::make('opening_balance'),
                Tables\Columns\TextColumn::make('active_since'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('company')
                    ->relationship(name: 'company',
                        titleAttribute: config('servicefund.company.title-attribute')),
                Tables\Filters\SelectFilter::make('type')
                    ->options(AccountType::class),
                Tables\Filters\SelectFilter::make('bank')
                    ->relationship('bank', 'name'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Account Status')
                    ->trueLabel('Active')
                    ->falseLabel('Inactive')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('is_active'),
                        false: fn (Builder $query) => $query->whereNull('is_active'),
                        blank: fn (Builder $query) => $query,
                    ),
            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->actions([
                Action::make('view')
                    ->url(fn (Account $record) => route('filament.service-fund.resources.accounts.dashboard', $record)),
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
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
            'dashboard' => Pages\AccountDashboard::route('/{record}/dashboard'),
            'debits' => Pages\AccountDebit::route('/{record}/debits'),
            'credits' => Pages\AccountCredit::route('/{record}/credits'),
            'debit-transfers' => Pages\AccountDebitTransfer::route('/{record}/debit-transfers'),
            'credit-transfers' => Pages\AccountDebitTransfer::route('/{record}/credit-transfers'),
        ];
    }
}
