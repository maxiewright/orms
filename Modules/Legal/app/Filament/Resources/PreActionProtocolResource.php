<?php

namespace Modules\Legal\Filament\Resources;

use App\Models\Serviceperson;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Legal\Enums\LegalAction\PreActionProtocolStatus;
use Modules\Legal\Filament\Resources\PreActionProtocolResource\Pages;
use Modules\Legal\Models\Ancillary\CourtAppearance\LegalProfessional;
use Modules\Legal\Models\Ancillary\Litigation\PreActionProtocolType;
use Modules\Legal\Models\LegalAction\Defendant;
use Modules\Legal\Models\LegalAction\PreActionProtocol;
use Modules\Legal\Services\Filters\DateBetweenFilter;
use Modules\Legal\Services\Filters\ServicepersonFilter;
use Modules\Legal\Services\Filters\StatusFilter;
use Modules\Legal\Services\Table\TableColumn;

class PreActionProtocolResource extends Resource
{
    protected static ?string $model = PreActionProtocol::class;

    protected static ?string $navigationGroup = 'Legal Actions';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Grid::make()
                    ->columns()
                    ->schema([
                        TextInput::make('subject')
                            ->columnSpanFull()
                            ->required()
                            ->unique(ignoreRecord: true),
                        Select::make('claimants')
                            ->relationship('claimants')
                            ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->military_name}")
                            ->placeholder('Select the serviceperson / servicepeople concerning this matter')
                            ->label('Claimant (s)')
                            ->columnSpanFull()
                            ->required()
                            ->multiple(),
                        Select::make('legalRepresentatives')
                            ->label('Claimants(s) Legal Representative')
                            ->relationship('legalRepresentatives', 'name')
                            ->createOptionForm(LegalProfessional::getForm())
                            ->required()
                            ->multiple()
                            ->preload(),
                        Select::make('defendants')
                            ->relationship('defendants', 'name')
                            ->createOptionForm(Defendant::getForm())
                            ->required()
                            ->multiple()
                            ->preload(),
                    ]),
                Grid::make()
                    ->columns(3)
                    ->schema([
                        Select::make('pre_action_protocol_type_id')
                            ->createOptionForm(PreActionProtocolType::getForm())
                            ->relationship('type', 'name')
                            ->required(),
                        DatePicker::make('dated_at')
                            ->label('Dated')
                            ->required()
                            ->beforeOrEqual('today'),
                        Select::make('status')
                            ->options(PreActionProtocolStatus::class)
                            ->enum(PreActionProtocolStatus::class)
                            ->default(PreActionProtocolStatus::Received)
                            ->required(),
                    ]),
                Grid::make()
                    ->columns(3)
                    ->schema([
                        Select::make('received_by')
                            ->relationship(
                                name: 'receiver',
                                titleAttribute: 'number',
                                modifyQueryUsing: fn (Builder $query) => $query
                                    ->whereHas('department', fn ($query) => $query
                                        ->where('slug', 'legal')))
                            ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->military_name}")
                            ->helperText('Search by number, first name, middle name or last name')
                            ->searchable(['number', 'first_name', 'middle_name', 'last_name'])
                            ->label('Received By')
                            ->preload()
                            ->required(),
                        DateTimePicker::make('received_at')
                            ->label('Date and Time Received')
                            ->beforeOrEqual('today')
                            ->after('dated_at')
                            ->seconds(false)
                            ->required(),
                        DateTimePicker::make('respond_by')
                            ->label('Response required by')
                            ->after('dated_at')
                            ->seconds(false)
                            ->required(),
                    ]),
                Select::make('parent_id')
                    ->label('Previous Pre Action Protocol')
                    ->columnSpanFull()
                    ->searchable()
                    ->preload(),
                DateTimePicker::make('responded_at')
                    ->label('Date Responded')
                    ->after('dated_at')
                    ->seconds(false),
                PreActionProtocol::getReferences()
                    ->columnSpan(2),
                RichEditor::make('particulars')
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(PreActionProtocol::query()
                ->with(['claimants', 'defendants', 'legalRepresentatives', 'type', 'receiver']))
            ->columns([
                Tables\Columns\TextColumn::make('subject')
                    ->description(fn (PreActionProtocol $record) => 'Dated: '.$record->dated_at->format(config('legal.date')))
                    ->searchable()
                    ->sortable(query: function (Builder $query, string $direction) {
                        $query->orderBy('dated_at', $direction);
                    })
                    ->label('Subject')
                    ->wrap(),
                TableColumn::serviceperson('claimants.military_name')
                    ->label('Claimant(s)')
                    ->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('defendants')
                    ->formatStateUsing(fn ($state) => $state->abbreviation ?? $state->name)
                    ->label('Defendant(s)')
                    ->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('legalRepresentatives.name')
                    ->label('Legal Representatives(s)')
                    ->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('type.name')
                    ->label('Type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('receiver.military_name')
                    ->searchable(['number', 'first_name', 'middle_name', 'last_name'])
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Received By'),
                Tables\Columns\TextColumn::make('received_at')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date(config('legal.datetime'))
                    ->label('Received At')
                    ->sortable(),
                Tables\Columns\TextColumn::make('respond_by')
                    ->color(function (PreActionProtocol $record) {
                        if ($record->hasDefaulted()) {
                            return Color::Red;
                        }

                        if ($record->hasResponded()) {
                            return Color::Green;
                        }

                        return Color::Amber;
                    })
                    ->icon('heroicon-o-clock')
                    ->date(config('legal.date'))
                    ->label('Respond By')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge(),
                Tables\Columns\TextColumn::make('responded_at')
                    ->placeholder('Response outstanding')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date(config('legal.datetime'))
                    ->label('Responded At')
                    ->sortable(),
            ])
            ->filters([
                ServicepersonFilter::rank('claimants'),
                ServicepersonFilter::battalion('claimants'),
                ServicepersonFilter::company('claimants'),
                StatusFilter::make(options: PreActionProtocolStatus::class),
                Tables\Filters\SelectFilter::make('type')
                    ->relationship('type', 'name')
                    ->multiple()
                    ->preload(),
                DateBetweenFilter::make('dated_at', 'dated_from', 'dated_to'),
                DateBetweenFilter::make('received_at', 'received_from', 'received_to'),
                DateBetweenFilter::make('respond_by', 'respond_from', 'respond_to'),
                DateBetweenFilter::make('responded_at', 'responded_from', 'responded_to'),
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->filtersFormColumns(6)
            ->filtersFormSchema(fn (array $filters): array => [
                Section::make()
                    ->columns(5)
                    ->columnSpanFull()
                    ->schema([
                        $filters['rank'],
                        $filters['battalion'],
                        $filters['company'],
                        $filters['status'],
                        $filters['type'],
                    ]),
                Section::make()
                    ->columns(4)
                    ->columnSpanFull()
                    ->schema([
                        $filters['dated_at'],
                        $filters['received_at'],
                        $filters['respond_by'],
                        $filters['responded_at'],
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
        return $infolist
            ->schema([
                Fieldset::make('Parties')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('claimants.military_name')
                            ->bulleted(fn ($state) => isset($state) && count($state) > 1)
                            ->label('Claimant(s)')
                            ->listWithLineBreaks(),
                        TextEntry::make('defendants')
                            ->formatStateUsing(fn ($state): string => $state->abbreviation ?? $state->name)
                            ->bulleted(fn ($state) => isset($state) && count($state) > 1)
                            ->label('Defendants(s)')
                            ->listWithLineBreaks(),
                        TextEntry::make('legalRepresentatives.name')
                            ->bulleted(fn ($state) => isset($state) && count($state) > 1)
                            ->label('Legal Representative (s)')
                            ->listWithLineBreaks(),
                    ]),
                Fieldset::make('Details')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('subject')
                            ->columnSpanFull(),
                        TextEntry::make('parent.subject')
                            ->hidden(fn ($state) => $state === null)
                            ->label('Last Related Pre Action Protocol')
                            ->columnSpanFull(),
                        TextEntry::make('type.name'),
                        TextEntry::make('dated_at')
                            ->date(config('legal.date')),
                        TextEntry::make('status')
                            ->badge(),
                    ]),
                Fieldset::make('Receipt & Response')
                    ->columns(4)
                    ->schema([
                        TextEntry::make('receiver.military_name'),
                        TextEntry::make('received_at')
                            ->date(config('legal.datetime')),
                        TextEntry::make('respond_by')
                            ->date(config('legal.date')),
                        TextEntry::make('responded_at')
                            ->placeholder('Response outstanding')
                            ->date(config('legal.date'))
                            ->label('Responded On'),
                    ]),
                Fieldset::make('References & Particulars')
                    ->schema([
                        TextEntry::make('references.name')
                            ->url(route('filament.legal.correspondence'))
                            ->bulleted(fn ($state) => count($state) > 1)
                            ->label('Reference(s)')
                            ->listWithLineBreaks()
                            ->columnSpanFull()
                            ->bulleted(),
                        TextEntry::make('particulars')
                            ->placeholder('No particulars provided')
                            ->columnSpanFull()
                            ->html(),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePreActionProtocols::route('/'),
        ];
    }
}
