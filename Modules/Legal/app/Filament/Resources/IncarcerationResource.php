<?php

namespace Modules\Legal\Filament\Resources;

use App\Models\Serviceperson;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Legal\Enums\JusticeInstitutionType;
use Modules\Legal\Filament\Resources\IncarcerationResource\Pages;
use Modules\Legal\Models\Ancillary\JusticeInstitution;
use Modules\Legal\Models\Incarceration;
use Modules\Legal\Models\Incident;
use Modules\Legal\Services\Filters\DateBetweenFilter;
use Modules\Legal\Services\Filters\ServicepersonFilter;

class IncarcerationResource extends Resource
{
    protected static ?string $model = Incarceration::class;

    protected static ?string $navigationGroup = 'Occurrences';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('serviceperson_number')
                    ->label('Serviceperson')
                    ->helperText('Search by number, first name, middle name or last name')
                    ->searchable(['number', 'first_name', 'middle_name', 'last_name'])
                    ->live()
                    ->options(function () {
                        return Serviceperson::query()
                            ->whereHas('incidents')
                            ->get()
                            ->pluck('military_name', 'number');
                    }),
                Select::make('incident_id')
                    ->label('Incident')
                    ->placeholder(fn (Get $get) => $get('serviceperson')
                        ? 'Select an incident'
                        : 'Select Serviceperson first')
                    ->options(function (?Incarceration $record, Get $get, Set $set) {
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
                Grid::make()
                    ->columns(3)
                    ->schema([
                        Select::make('justice_institution_id')
                            ->label('Correctional Facility')
                            ->options(function (?Incarceration $record, Get $get, Set $set) {
                                if (! empty($record)) {
                                    $set('justice_institution_id', $record->justice_institution_id);
                                }

                                return JusticeInstitution::query()
                                    ->where('type', 'correctional facility')
                                    ->get()
                                    ->pluck('name', 'id');
                            })
                            ->createOptionForm(JusticeInstitution::getForm(type: JusticeInstitutionType::CorrectionalFacility))
                            ->required(),
                        DateTimePicker::make('incarcerated_at')
                            ->label('Date Incarcerated')
                            ->seconds(false)
                            ->required()
                            ->beforeOrEqual('now'),
                        DateTimePicker::make('released_at')
                            ->label('Date Released')
                            ->seconds(false)
                            ->after('incarcerated_at')
                            ->beforeOrEqual('now'),
                    ]),
                Incarceration::getReferences()->columnSpanFull(),
                RichEditor::make('particulars')
                    ->label('Particulars')
                    ->columnSpanFull(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Fieldset::make('Incident')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('serviceperson')
                            ->label('Serviceperson')
                            ->formatStateUsing(function ($state) {
                                return "$state->military_name <br> {$state->battalion?->short_name} - {$state->company?->short_name}";
                            })->html(),
                        TextEntry::make('incident')
                            ->formatStateUsing(function ($state) {
                                $type = ucfirst($state->type->value);

                                return "$type - $state->occurrence_date";
                            }),
                        TextEntry::make('incident.status')
                            ->label('Status')
                            ->badge(),
                    ]),
                Fieldset::make('Incarceration')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('incarcerated_at')
                            ->label('Incarceration Date')
                            ->date(config('legal.date')),
                        TextEntry::make('correctionalFacility.name')
                            ->label('Correctional Facility'),
                        TextEntry::make('released_at')
                            ->label('Date Released')
                            ->date(config('legal.date'))
                            ->placeholder('Still Incarcerated'),
                    ]),
                Fieldset::make('References & Particulars')
                    ->schema([
                        TextEntry::make('references.name')
                            ->url(route('filament.legal.correspondence'))
                            ->columnSpanFull()
                            ->bulleted(),
                        TextEntry::make('particulars')
                            ->placeholder('No particulars provided')
                            ->columnSpanFull()
                            ->html(),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('serviceperson.military_name')
                    ->searchable(['number', 'first_name', 'middle_name', 'last_name']),
                Tables\Columns\TextColumn::make('incident.type')
                    ->label('Incident')
                    ->searchable(['name', 'type'])
                    ->description(fn ($record) => $record->incident->date),
                Tables\Columns\TextColumn::make('incarcerated_at')
                    ->label('Incarceration Date')
                    ->date(config('legal.date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('correctionalFacility.name')
                    ->label('Correctional Facility')
                    ->searchable(),
                Tables\Columns\TextColumn::make('released_at')
                    ->label('Date Released')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date(config('legal.date'))
                    ->sortable(),
            ])
            ->filters([
                ServicepersonFilter::rank(),
                ServicepersonFilter::battalion(),
                ServicepersonFilter::company(),
                Tables\Filters\SelectFilter::make('correctionalFacility')
                    ->relationship('correctionalFacility', 'name')
                    ->searchable()
                    ->preload(),
                DateBetweenFilter::make('incarcerated_at', 'incarcerated_from', 'incarcerated_to'),
                DateBetweenFilter::make('released_at', 'released_from', 'released_to'),
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageIncarcerations::route('/'),
        ];
    }
}
