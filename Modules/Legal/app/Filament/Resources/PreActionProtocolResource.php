<?php

namespace Modules\Legal\Filament\Resources;

use App\Models\Serviceperson;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Legal\Enums\LegalAction\PreActionProtocolStatus;
use Modules\Legal\Filament\Resources\PreActionProtocolResource\Pages;
use Modules\Legal\Models\Ancillary\CourtAppearance\LegalProfessional;
use Modules\Legal\Models\Ancillary\Litigation\PreActionProtocolType;
use Modules\Legal\Models\LegalAction\Defendant;
use Modules\Legal\Models\LegalAction\PreActionProtocol;

class PreActionProtocolResource extends Resource
{
    protected static ?string $model = PreActionProtocol::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                            ->unique(),
                        Serviceperson::make(relationship: 'claimants')
                            ->placeholder('Select the serviceperson / servicepeople concerning this matter')
                            ->label('Claimant (s)')
                            ->columnSpanFull()
                            ->required()
                            ->multiple(),
                        Select::make('legalRepresentatives')
                            ->label('Claimants(s) Legal Representative')
                            ->relationship('legalRepresentatives', 'name')
                            ->createOptionForm(LegalProfessional::getForm())
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
                            ->default(PreActionProtocolStatus::Pending)
                            ->required(),
                    ]),
                Grid::make()
                    ->columns(3)
                    ->schema([
                        Serviceperson::make('received_by', 'receiver')
                            ->label('Received By')
                            ->preload(),
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

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //

                //                'pre_action_protocol_type_id',
                //                'parent_id',
                //                'lawyer_id',
                //                'dated_at',
                //                'received_by',
                //                'received_at',
                //                'respond_by',
                //                'status',
                //                'responded_at',
            ])
            ->filters([
                //
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
                //                'pre_action_protocol_type_id',
                //                'parent_id',
                //                'lawyer_id',
                //                'dated_at',
                //                'received_by',
                //                'received_at',
                //                'respond_by',
                //                'status',
                //                'responded_at',
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePreActionProtocols::route('/'),
        ];
    }
}
