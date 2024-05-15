<?php

namespace Modules\Legal\Filament\Resources;

use App\Models\Serviceperson;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Legal\Enums\CourtAppearanceOutcome;
use Modules\Legal\Enums\CourtAppearanceReason;
use Modules\Legal\Enums\JusticeInstitutionType;
use Modules\Legal\Enums\LegalProfessionalType;
use Modules\Legal\Filament\Resources\CourtAppearanceResource\Pages;
use Modules\Legal\Models\Ancillary\CourtAppearance\LegalProfessional;
use Modules\Legal\Models\Ancillary\JusticeInstitution;
use Modules\Legal\Models\CourtAppearance;
use Modules\Legal\Models\Incident;

class CourtAppearanceResource extends Resource
{
    protected static ?string $model = CourtAppearance::class;

    protected static ?string $navigationGroup = 'Court';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Repeater::make('servicepeopleCourtAppearances')
                    ->label('Serviceperson(s)')
                    ->relationship()
                    ->columns(3)
                    ->columnSpanFull()
                    ->schema([
                        Serviceperson::make()
                            ->label('Serviceperson')
                            ->placeholder('Select Serviceperson')
                            ->searchable()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state) {
                                if (! $state) {
                                    self::resetPreviousCourtAttendanceFields($set);

                                    return;
                                }
                                $previous = self::getPreviousCourtAppearance($state);

                                self::setPreviousCourtAttendanceFields($set, $previous);
                            }),
                        Select::make('incident_id')
                            ->helperText('Select the incident related to this court appearance')
                            ->label('Incident')
                            ->options(function (Get $get) {
                                return Incident::query()
                                    ->where('serviceperson_number', $get('serviceperson_number'))
                                    ->pluck('name', 'id');
                            })
                            ->placeholder(fn (Get $get) => $get('serviceperson_number')
                                ? 'Select Incident'
                                : 'Select Serviceperson First'
                            )
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->live(),
                        Select::make('reason')
                            ->helperText('Select other reason if not a hearing')
                            ->options(CourtAppearanceReason::class)
                            ->enum(CourtAppearanceReason::class)
                            ->default(CourtAppearanceReason::Hearing)
                            ->searchable()
                            ->preload()
                            ->label('Reason')
                            ->required()
                            ->nullable()
                            ->live(),
                    ])
                    ->addActionLabel('Add Serviceperson'),
                Select::make('justice_institution_id')
                    ->label('Court')
                    ->placeholder('Select Court')
                    ->relationship(name: 'court', titleAttribute: 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm(JusticeInstitution::getForm(type: JusticeInstitutionType::MagistrateCourt)),
                DateTimePicker::make('attended_at')
                    ->label('Date Attended')
                    ->required(fn (Get $get) => $get('next_date'))
                    ->live(),
                Serviceperson::make(name: 'accompanied_by', relationship: 'accompaniedBy')
                    ->label('Accompanied By')
                    ->nullable(),
                Select::make('outcome')
                    ->label('Outcome')
                    ->options(CourtAppearanceOutcome::class)
                    ->enum(CourtAppearanceOutcome::class)
                    ->required(fn (Get $get) => $get('attended_at'))
                    ->live(),
                DateTimePicker::make('next_date')
                    ->label('Next Date')
                    ->required(fn (Get $get) => ! $get('attended_at'))
                    ->after('today')
                    ->live(),
                TextInput::make('bail_amount')
                    ->numeric()
                    ->prefix('TTD')
                    ->label('Bail Amount')
                    ->nullable(),
                Select::make('judge_id')
                    ->createOptionForm(LegalProfessional::getForm(type: LegalProfessionalType::Magistrate))
                    ->label('Magistrate / Judge')
                    ->relationship(
                        name: 'judge',
                        titleAttribute: 'name',
                        modifyQueryUsing: function ($query) {
                            return $query
                                ->where('type', LegalProfessionalType::Magistrate)
                                ->orWhere('type', LegalProfessionalType::Judge);
                        })
                    ->searchable()
                    ->placeholder('Select Magistrate / Judge')
                    ->preload()
                    ->nullable(),
                Select::make('lawyer_id')
                    ->createOptionForm(LegalProfessional::getForm(type: LegalProfessionalType::Lawyer))
                    ->placeholder('Select Lawyer')
                    ->label('Lawyer')
                    ->relationship(
                        name: 'lawyer',
                        titleAttribute: 'name',
                        modifyQueryUsing: function ($query) {
                            return $query->where('type', LegalProfessionalType::Lawyer);
                        })
                    ->searchable()
                    ->preload()
                    ->nullable(),
                Select::make('prosecutor_id')
                    ->createOptionForm(LegalProfessional::getForm(type: LegalProfessionalType::Prosecutor))
                    ->label('Prosecutor')
                    ->placeholder('Select Prosecutor')
                    ->relationship(
                        name: 'prosecutor',
                        titleAttribute: 'name',
                        modifyQueryUsing: function ($query) {
                            return $query->where('type', LegalProfessionalType::Prosecutor);
                        })
                    ->searchable()
                    ->preload()
                    ->nullable(),

                RichEditor::make('particulars')
                    ->helperText('Enter any additional information')
                    ->label('Particulars')
                    ->columnSpanFull()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('servicepeople.military_name')
                    ->label('Serviceperson(s)'),
                Tables\Columns\TextColumn::make('court.name')
                    ->label('Court'),
                Tables\Columns\TextColumn::make('attended_at')
                    ->date('D, d M y')
                    ->label('Date Attended'),
                Tables\Columns\TextColumn::make('accompaniedBy.military_name')
                    ->label('Accompanied By'),
                Tables\Columns\TextColumn::make('outcome')
                    ->label('Outcome'),
                Tables\Columns\TextColumn::make('next_date')
                    ->date('D, d M y')
                    ->label('Next Date'),
                Tables\Columns\TextColumn::make('bail_amount')
                    ->label('Bail Amount')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('judge.name')
                    ->label('Magistrate / Judge')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('lawyer.name')
                    ->label('Lawyer')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('prosecutor.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Prosecutor'),
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
            'index' => Pages\ListCourtAppearance::route('/'),
            'create' => Pages\CreateCourtAppearance::route('/create'),
            'edit' => Pages\EditCourtAppearance::route('/{record}/edit'),
        ];
    }

    public static function resetPreviousCourtAttendanceFields(Set $set): void
    {
        $set('../../justice_institution_id', '');
        $set('../../attended_at', '');
        $set('../../accompanied_by', '');
        $set('../../judge_id', '');
        $set('../../lawyer_id', '');
        $set('../../prosecutor_id', '');

    }

    public static function setPreviousCourtAttendanceFields(Set $set, $previous): void
    {
        if ($previous->exists()){
            $set('../../justice_institution_id', $previous->justice_institution_id);
            $set('../../attended_at', Carbon::make($previous->next_date)->toDateTimeString());
            $set('../../accompanied_by', $previous->accompanied_by);
            $set('../../judge_id', $previous->judge_id);
            $set('../../lawyer_id', $previous->lawyer_id);
            $set('../../prosecutor_id', $previous->prosecutor_id);
        }

    }


    public static function getPreviousCourtAppearance($state)
    {
        return CourtAppearance::query()
            ->whereHas('servicepeople', fn ($query) => $query
                ->where('serviceperson_number', $state))
            ->latest('attended_at');
    }
}
