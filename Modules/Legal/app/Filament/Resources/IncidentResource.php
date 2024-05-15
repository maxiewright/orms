<?php

namespace Modules\Legal\Filament\Resources;

use App\Models\Metadata\Contact\City;
use App\Models\Serviceperson;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Legal\Enums\IncidentStatus;
use Modules\Legal\Filament\Resources\IncidentResource\Pages;
use Modules\Legal\Models\Charge;
use Modules\Legal\Models\Incident;

class IncidentResource extends Resource
{
    protected static ?string $model = Incident::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        Serviceperson::make()
                            ->label('Serviceperson')
                            ->required(),
                        Forms\Components\DateTimePicker::make('occurred_at')
                            ->label('Date and Time')
                            ->required()
                            ->before('now')
                            ->seconds(false),
                        Forms\Components\Select::make('status')
                            ->options(IncidentStatus::class)
                            ->default(IncidentStatus::Pending)
                            ->enum(IncidentStatus::class)
                            ->required()
                            ->live(),
                    ]),
                Forms\Components\Fieldset::make('Location')
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
                    ->hidden(fn (Get $get) => $get('status') === IncidentStatus::Pending)
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
            ->columns([
                Tables\Columns\TextColumn::make('serviceperson.military_name')
                    ->label('Serviceperson')
                    ->searchable(['serviceperson.number', 'serviceperson.first_name', 'serviceperson.middle_name', 'serviceperson.last_name'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('serviceperson.battalion')
                    ->label('Unit')
                    ->placeholder('Unit - Coy')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('occurred_at')
                    ->dateTime(config('legal.datetime_format'))
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
                    ->counts('charges')
                    ->label('Charges')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(IncidentStatus::class)
                    ->label('Status'),
                Tables\Filters\SelectFilter::make('rank')
                    ->relationship('serviceperson.rank', 'regiment_abbreviation')
                    ->label('Rank'),
                Tables\Filters\SelectFilter::make('battalion')
                    ->relationship('serviceperson.battalion', 'name')
                    ->label('Battalion'),
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
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
            'index' => Pages\ListIncidents::route('/'),
            'create' => Pages\CreateIncident::route('/create'),
            'edit' => Pages\EditIncident::route('/{record}/edit'),
        ];
    }
}
