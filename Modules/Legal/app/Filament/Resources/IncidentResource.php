<?php

namespace Modules\Legal\Filament\Resources;

use App\Models\Metadata\Contact\City;
use App\Models\Serviceperson;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Legal\Enums\Incident\IncidentStatus;
use Modules\Legal\Enums\Incident\IncidentType;
use Modules\Legal\Filament\Resources\IncidentResource\Pages;
use Modules\Legal\Models\Charge;
use Modules\Legal\Models\Incident;
use Modules\Legal\Services\Filters\DateBetweenFilter;
use Modules\Legal\Services\Filters\ServicepersonFilter;
use Modules\Legal\Services\Filters\StatusFilter;
use Modules\Legal\Services\Filters\TypeFilter;

class IncidentResource extends Resource
{
    protected static ?string $model = Incident::class;

    protected static ?string $navigationGroup = 'Occurrences';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Incident Details')
                    ->columnSpanFull()
                    ->columns(4)
                    ->schema([
                        Serviceperson::make()
                            ->label('Serviceperson')
                            ->required()
                            ->live(),
                        Forms\Components\Select::make('type')
                            ->options(IncidentType::class)
                            ->required()
                            ->live(),
                        Forms\Components\DateTimePicker::make('occurred_at')
                            ->label('Date and Time')
                            ->required()
                            ->before('now')
                            ->seconds(false)
                            ->live(),
                        Forms\Components\Select::make('status')
                            ->options(IncidentStatus::class)
                            ->default(function (?Incident $incident) {
                                if ($incident->charges()->exists()) {
                                    return IncidentStatus::Charged;
                                }
                                return IncidentStatus::PendingCharge;
                            })
                            ->enum(IncidentStatus::class)
                            ->required()
                            ->live(),
                    ]),
                Forms\Components\Section::make('Location')
                    ->columnSpanFull()
                    ->columns()
                    ->schema([
                        Forms\Components\TextInput::make('address_line_1')
                            ->label('Address Line 1')
                            ->required(),
                        Forms\Components\TextInput::make('address_line_2')
                            ->label('Address Line 2'),
                        Forms\Components\Select::make('division_id')
                            ->label('Division')
                            ->relationship('division', 'name')
                            ->required()
                            ->live(),
                        Forms\Components\Select::make('city_id')
                            ->label('City')
                            ->placeholder(fn (Get $get) => empty($get('division_id')) ? 'Select Division First' : 'Select City')
                            ->options(function (Get $get) {
                                return City::query()
                                    ->where('division_id', $get('division_id'))
                                    ->pluck('name', 'id');
                            })
                            ->required(),
                    ]),
                Repeater::make('charges')
                    ->hidden(fn (Get $get) => $get('status') === IncidentStatus::PendingCharge)
                    ->relationship('charges')
                    ->columns(3)
                    ->columnSpanFull()
                    ->schema(Charge::getForm())
                    ->addActionLabel('Add Charge'),
                Forms\Components\RichEditor::make('particulars')
                    ->label('Particulars')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Incident::query())
            ->recordUrl(fn (Model $record): string => route('filament.legal.resources.incidents.view', $record))
            ->columns([
                Tables\Columns\TextColumn::make('serviceperson.military_name')
                    ->description(function ($record): string {
                        $record->serviceperson->load(['battalion', 'company']);
                        $battalion = $record->serviceperson->battalion;

                        if ($battalion) {
                            return $record->serviceperson?->battalion?->short_name.' - '.$record->serviceperson?->company?->short_name;
                        }

                        return '';
                    })
                    ->label('Serviceperson')
                    ->searchable(['serviceperson.number', 'serviceperson.first_name', 'serviceperson.middle_name', 'serviceperson.last_name'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('occurred_at')
                    ->dateTime(config('legal.datetime'))
                    ->label('Date and Time')
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->wrap()
                    ->label('Incident Location')
                    ->searchable(['address_line_1', 'address_line_2', 'division.name', 'city.name']),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('charges_count')
                    ->alignCenter()
                    ->counts('charges')
                    ->label('Charges')
                    ->sortable(),
            ])
            ->defaultSort('occurred_at', 'desc')
            ->filters([
                ServicepersonFilter::rank(),
                ServicepersonFilter::battalion(),
                ServicepersonFilter::company(),
                StatusFilter::make(options: IncidentStatus::class),
                TypeFilter::make(options: IncidentType::class),
                DateBetweenFilter::make('occurred_at', 'occurred_from', 'occurred_to'),
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->filtersFormColumns(5)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
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
        return $infolist
            ->schema([
                Section::make('Incident Details')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('serviceperson.military_name'),
                        TextEntry::make('type')
                            ->badge(),
                        TextEntry::make('occurred_at')
                            ->label('Date and Time')
                            ->dateTime(config('legal.datetime')),
                        TextEntry::make('address')
                            ->label('Incident Address'),
                        TextEntry::make('status')
                            ->badge(),
                        TextEntry::make('particulars'),
                    ]),
                Section::make('Charges')
                    ->hidden(fn (Model $record): bool => ! $record->charges()->exists())
                    ->schema([
                        RepeatableEntry::make('charges')
                            ->grid()
                            ->label('')
                            ->columnSpanFull()
                            ->columns()
                            ->schema([
                                TextEntry::make('offenceSection.name')
                                    ->label('Offence'),
                                TextEntry::make('charged_at')
                                    ->label('Charged on')
                                    ->dateTime(config('legal.datetime')),
                                TextEntry::make('policeStation.name')
                                    ->label('Charged At'),
                                TextEntry::make('charged_by')
                                    ->label('Laid By'),
                                TextEntry::make('particulars')
                                    ->columnSpanFull()
                                    ->alignJustify()
                                    ->html(),

                            ]),
                    ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
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
            'index' => Pages\ListIncidents::route('/'),
            'create' => Pages\CreateIncident::route('/create'),
            'edit' => Pages\EditIncident::route('/{record}/edit'),
            'view' => Pages\ViewIncident::route('/{record}'),
        ];
    }
}
