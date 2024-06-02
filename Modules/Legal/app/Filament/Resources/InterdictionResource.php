<?php

namespace Modules\Legal\Filament\Resources;

use App\Models\Serviceperson;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Legal\Enums\InterdictionStatus;
use Modules\Legal\Filament\Resources\InterdictionResource\Pages;
use Modules\Legal\Models\Incident;
use Modules\Legal\Models\Interdiction;
use Modules\Legal\Services\Filters\DateBetweenFilter;
use Modules\Legal\Services\Filters\ServicepersonFilter;
use Modules\Legal\Services\Filters\StatusFilter;

class InterdictionResource extends Resource
{
    protected static ?string $model = Interdiction::class;

    protected static ?string $navigationGroup = 'Occurrences';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\Select::make('serviceperson_number')
                    ->label('Serviceperson')
                    ->helperText('Search by number, first name, middle name or last name')
                    ->searchable(['number', 'first_name', 'middle_name', 'last_name'])
                    ->searchable()
                    ->live()
                    ->options(function () {
                        return Serviceperson::query()
                            ->whereHas('incidents')
                            ->get()
                            ->pluck('military_name', 'number');
                    }),
                Forms\Components\Select::make('incident_id')
                    ->label('Incident')
                    ->placeholder(fn (Get $get) => $get('serviceperson')
                        ? 'Select an incident'
                        : 'Select Serviceperson first')
                    ->options(function (?Interdiction $record, Get $get, Forms\Set $set) {
                        if (! empty($record) && empty($get('serviceperson_number'))) {
                            $set('serviceperson_number', $record->incident->serviceperson_number);
                            $set('incident_id', $record->incident_id);
                        }

                        return Incident::query()
                            ->where('serviceperson_number', $get('serviceperson_number'))
                            ->get()
                            ->pluck('name', 'id');
                    })
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'A interdiction record already exist for this incident',
                    ])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options(InterdictionStatus::class)
                    ->enum(InterdictionStatus::class)
                    ->default(InterdictionStatus::Pending)
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state) {
                        if ($state == InterdictionStatus::Pending->value) {
                            $set('interdicted_at', null);
                            $set('revoked_at', null);
                        }
                    }),
                Forms\Components\DateTimePicker::make('requested_at')
                    ->label('Date Requested')
                    ->seconds(false)
                    ->required()
                    ->beforeOrEqual('now'),
                Forms\Components\DateTimePicker::make('interdicted_at')
                    ->label('Date Interdicted')
                    ->seconds(false)
                    ->required(fn (Get $get) => $get('status') == InterdictionStatus::Interdicted->value)
                    ->beforeOrEqual('now')
                    ->after('requested_at')
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state) {
                        if ($state) {
                            $set('status', InterdictionStatus::Interdicted);
                        }
                    }),
                Forms\Components\DateTimePicker::make('revoked_at')
                    ->label('Date Revoked')
                    ->seconds(false)
                    ->required(fn (Get $get) => $get('status') == InterdictionStatus::Revoked->value)
                    ->after('interdicted_at')
                    ->afterStateUpdated(function (Set $set, $state) {
                        if ($state) {
                            $set('status', InterdictionStatus::Revoked);
                        }
                    }),
                Interdiction::getReferences()->columnSpanFull(),
                Forms\Components\RichEditor::make('particulars')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Interdiction::query()
                ->with([
                    'serviceperson.formation',
                    'serviceperson.battalion',
                    'serviceperson.company',
                    'incident.city',
                    'incident.division.cities',
                    'charges',
                ])
            )
            ->columns([
                Tables\Columns\TextColumn::make('serviceperson.military_name')
                    ->description(function ($record) {
                        return $record->serviceperson?->company?->short_name;
                    })
                    ->label('Serviceperson'),
                Tables\Columns\TextColumn::make('incident.type')
                    ->label('Incident')
                    ->description(fn ($record) => $record->incident->date),
                Tables\Columns\TextColumn::make('charges_count')
                    ->tooltip('Click record to see list of charges')
                    ->alignCenter()
                    ->counts('charges')
                    ->label('Charges'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('requested_at')
                    ->date(config('legal.date'))
                    ->label('Request Date')
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('interdicted_at')
                    ->toggleable()
                    ->label('Interdiction Date')
                    ->placeholder('Pending Response')
                    ->date(config('legal.date')),
                Tables\Columns\TextColumn::make('revoked_at')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Revocation Date')
                    ->placeholder(function ($record) {
                        return $record->status == InterdictionStatus::Interdicted
                            ? 'On going'
                            : 'Pending Response';
                    })
                    ->date(),
            ])
            ->recordAction(Tables\Actions\ViewAction::class)
            ->filters([
                ServicepersonFilter::rank(),
                ServicepersonFilter::battalion(),
                ServicepersonFilter::company(),
                StatusFilter::make(options: InterdictionStatus::class),
                DateBetweenFilter::make('requested_at', 'requested_from', 'requested_to'),
                DateBetweenFilter::make('interdicted_at', 'interdicted_from', 'interdicted_to'),
                DateBetweenFilter::make('revoked_at', 'revoked_from', 'revoked_to'),
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->filtersFormColumns(6)
            ->filtersFormSchema(fn (array $filters): array => [
                Section::make()
                    ->columns(6)
                    ->columnSpanFull()
                    ->schema([
                        $filters['rank'],
                        $filters['battalion'],
                        $filters['company'],
                        $filters['status'],
                    ]),
                Section::make()
                    ->columns(6)
                    ->columnSpanFull()
                    ->schema([
                        $filters['requested_at'],
                        $filters['interdicted_at'],
                        $filters['revoked_at'],
                    ]),

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->slideOver()
                        ->extraModalFooterActions([
                            Tables\Actions\EditAction::make()->slideOver(),
                            Tables\Actions\DeleteAction::make(),
                            Tables\Actions\ForceDeleteAction::make(),
                            Tables\Actions\RestoreAction::make(),
                        ]),
                    Tables\Actions\EditAction::make()
                        ->slideOver(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ]),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(Pages\ViewInterdiction::infolistSchema());
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInterdiction::route('/'),
            //            'view' => Pages\ViewInterdiction::route('/{record}')
        ];
    }
}
