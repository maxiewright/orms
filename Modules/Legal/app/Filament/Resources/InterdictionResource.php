<?php

namespace Modules\Legal\Filament\Resources;

use App\Models\Serviceperson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Legal\Enums\InterdictionStatus;
use Modules\Legal\Filament\Resources\InterdictionResource\Pages;
use Modules\Legal\Models\Incident;
use Modules\Legal\Models\Interdiction;

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
                    ->required()
                    ->beforeOrEqual('now'),
                Forms\Components\DateTimePicker::make('interdicted_at')
                    ->label('Date Interdicted')
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
            ->columns([
                Tables\Columns\TextColumn::make('incident.serviceperson.military_name')
                    ->description(function ($record) {
                        return $record->incident->serviceperson?->company?->short_name;
                    })
                    ->label('Serviceperson'),
                Tables\Columns\TextColumn::make('incident.type')
                    ->label('Type')
                    ->description(fn ($record) => $record->incident->date),
                Tables\Columns\TextColumn::make('incident.charges.offenceSection.name')
                    ->listWithLineBreaks()
                    ->bulleted()
                    ->wrap()
                    ->label('Charges'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('requested_at')
                    ->toggleable(isToggledHiddenByDefault: function ($record) {
                        return $record?->status !== InterdictionStatus::Pending;
                    })
                    ->label('Request Date')
                    ->date(config('legal.date')),
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
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(InterdictionStatus::class),
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver(),
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
            'index' => Pages\ListInterdiction::route('/'),
        ];
    }
}
