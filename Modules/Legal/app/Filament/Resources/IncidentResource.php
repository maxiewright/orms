<?php

namespace Modules\Legal\Filament\Resources;

use App\Models\Metadata\Contact\City;
use App\Models\Serviceperson;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
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
                    ->columns(3)
                    ->schema([
                        Serviceperson::make()
                            ->label('Serviceperson')
                            ->required()
                            ->live(),
                        Forms\Components\Select::make('type')
                            ->helperText(function (Get $get) {
                                return $get('occurred_at')
                                    ? 'Select the type of incident that occurred.'
                                    : 'Select a serviceperson first to enable this field.';
                            })
                            ->disabled(fn (Get $get) => ! $get('serviceperson_number'))
                            ->options(IncidentType::class)
                            ->required()
                            ->live(),
                        Forms\Components\DateTimePicker::make('occurred_at')
                            ->helperText(function (Get $get) {
                                return $get('serviceperson_number')
                                    ? 'Select the date and time the incident occurred.'
                                    : 'Select a date and time first to enable this field.';
                            })
                            ->label('Date and Time')
                            ->disabled(fn (Get $get) => ! $get('type'))
                            ->required()
                            ->before('now')
                            ->seconds(false)
                            ->live()
                            ->afterStateUpdated(function (Set $set, Get $get, $state) {
                                $serviceperson = Serviceperson::find($get('serviceperson_number'));
                                $type = $get('type');
                                $time = Carbon::make($state)->format('d M Y');

                                if ($serviceperson && $time) {
                                    $set('name', "$serviceperson->number $type $time");
                                }
                            }),
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
                        Forms\Components\TextInput::make('name')
                            ->helperText('This field is automatically generated based on the serviceperson, incident type, and date of the incident.')
                            ->readOnly()
                            ->label('Incident Identifier')
                            ->required(),
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
                    ->hidden(fn (Get $get) => $get('status') === IncidentStatus::PendingCharge->value)
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
            ->filters([

                Tables\Filters\SelectFilter::make('status')
                    ->options(IncidentStatus::class)
                    ->multiple()
                    ->preload()
                    ->label('Status'),
                Tables\Filters\SelectFilter::make('rank')
                    ->relationship('serviceperson.rank', 'regiment_abbreviation')
                    ->label('Rank')
                    ->multiple()
                    ->preload(),
                Tables\Filters\SelectFilter::make('battalion')
                    ->relationship('serviceperson.battalion', 'name')
                    ->label('Battalion')
                    ->multiple()
                    ->preload(),
                Tables\Filters\Filter::make('occurred_at')
                    ->columns()
                    ->columnSpan(2)
                    ->form([
                        Forms\Components\DatePicker::make('occurred_from'),
                        Forms\Components\DatePicker::make('occurred_to'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['occurred_from'],
                                fn (Builder $query, $date): Builder => $query
                                    ->whereDate('occurred_at', '>=', $date))
                            ->when($data['occurred_to'],
                                fn (Builder $query, $date): Builder => $query
                                    ->whereDate('occurred_at', '<=', $date));
                    }),
                Tables\Filters\TrashedFilter::make(),
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
