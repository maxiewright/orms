<?php

namespace App\Filament\Resources;

use App\Enums\Interview\InterviewStatusEnum;
use App\Enums\RankEnum;
use App\Filament\Resources\InterviewResource\Pages;
use App\Models\Interview;
use App\Models\Unit\Battalion;
use App\Models\Unit\Company;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class InterviewResource extends Resource
{
    protected static ?string $model = Interview::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 2;

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'servicepeople.number', 'servicepeople.first_name', 'servicepeople.last_name',
            'reason.name',
        ];
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->servicepeople()->first()->military_name;
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()
            ->with(['servicepeople', 'reason', 'status']);
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Reason' => $record->reason->name,
            'Status' => $record->status->name,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Interview')->schema([
                // Request
                Tabs\Tab::make('Request')->schema([
                    Grid::make(1)->schema(components: [
                        Select::make('servicepeople')
                            ->helperText('To select a serviceperson, start typing their number, first name, middle name or last name')
                            ->label('Serviceperson(s)')
                            ->multiple()
                            ->relationship(
                                name: 'servicepeople',
                                titleAttribute: 'number',
                            )
                            ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->military_name}")
                            ->searchable(['number', 'first_name', 'middle_name', 'last_name'])
                            ->required(),
                    ]),
                    Grid::make(4)->schema(components: [
                        Select::make('battalion')
                            ->options(Battalion::all()->pluck('name', 'id'))
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('company_id', null)),

                        Select::make('company_id')
                            ->label('Company')
                            ->placeholder(function (callable $get) {
                                $battalion = Battalion::find($get('battalion'));

                                return ($battalion)
                                    ? "Select {$battalion->short_name} Company"
                                    : 'Select Battalion First';
                            })
                            ->options(function (callable $get) {
                                $battalion = Battalion::find($get('battalion'));

                                return ($battalion)
                                    ? $battalion->companies()->pluck('name', 'id')
                                    : Company::all()->pluck('name', 'id');
                            })
                            ->required(),

                        Select::make('requested_by')
                            ->relationship('requestedBy', 'number',
                                fn (Builder $query) => $query->where('rank_id', '>=', RankEnum::O1))
                            ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->military_name}")
                            ->searchable(['number', 'first_name', 'last_name'])
                            ->required(),
                        DatePicker::make('requested_at')
                            ->label('Date Requested')
                            ->displayFormat('d M Y')
                            ->required()
                            ->beforeOrEqual('today'),
                    ]),
                    Grid::make(3)->schema([
                        Select::make('interview_reason_id')
                            ->relationship('reason', 'name')
                            ->required(),
                        TextInput::make('subject')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                    ]),
                ]),
                // Particulars
                Tabs\Tab::make('Particulars')->schema([
                    RichEditor::make('particulars')
                        ->maxLength(65535)
                        ->columnSpan(1),
                    Repeater::make('attendees')->relationship()->schema([
                        Select::make('serviceperson_number')
                            ->label('Attendee (s)')
                            ->relationship('serviceperson', 'number')
                            ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->military_name}")
                            ->searchable(['number', 'first_name', 'last_name']),
                        Select::make('attendee_role_id')
                            ->label('Role')
                            ->relationship('role', 'name')
                            ->requiredIf(fn (callable $get) => $get('attendees'), ! null),

                    ])
                        ->columns()
                        ->defaultItems(0)
                        ->createItemButtonLabel('Add Interview Attendee')
                        ->collapsible(),
                    Grid::make(3)->schema([
                        Select::make('seen_by')
                            ->relationship('seenBy', 'number',
                                fn (Builder $query) => $query->where('rank_id', '>=', RankEnum::O1))
                            ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->military_name}")
                            ->searchable(['number', 'first_name', 'last_name']),
                        DatePicker::make('seen_at')
                            ->format('d M Y')
                            ->beforeOrEqual('today')
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('interview_status_id', 3)),
                        Select::make('interview_status_id')
                            ->label('Status')
                            ->relationship('status', 'name')
                            ->default(InterviewStatusEnum::PENDING->value)
                            ->required(),
                    ]),
                ]),
            ])->columnSpan(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('servicepeople.image_url')
                    ->label('Photo')
                    ->stacked()
                    ->circular()
                    ->wrap()
                    ->size(40),
                TextColumn::make('servicepeople.military_name')
                    ->listWithLineBreaks()
                    ->label('Serviceperson(s)')
                    ->searchable(['number', 'first_name', 'last_name']),
                TextColumn::make('requestedBy.military_name')
                    ->description(fn (Interview $record): string => "On: {$record->requested_at->format('d M Y')}")
                    ->searchable(['number', 'first_name', 'last_name']),
                TextColumn::make('reason.name')
                    ->wrap()
                    ->description(function (Interview $record) {
                        return str()->excerpt($record->subject);
                    }),
                TextColumn::make('status.name')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Seen' => 'success',
                        'Cancelled' => 'gray',
                    }),
                TextColumn::make('seenBy.military_name')
                    ->description(function (Interview $record): string {
                        return $record->seen_at
                            ? "On: {$record->seen_at?->format('d M Y')}"
                            : '';
                    })->placeholder('Not yet Seen'),
            ])
            ->defaultSort('requested_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->relationship('status', 'name'),
                SelectFilter::make('reason')
                    ->relationship('reason', 'name'),
                SelectFilter::make('rank')
                    ->relationship('servicepeople.rank', 'regiment')
                    ->searchable()
                    ->multiple()
                    ->preload(),
                Filter::make('requested_at')
                    ->form([
                        DatePicker::make('request_start'),
                        DatePicker::make('request_end'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['request_start'],
                                fn (Builder $query, $date): Builder => $query->whereDate('requested_at', '>=', $date),
                            )
                            ->when(
                                $data['request_end'],
                                fn (Builder $query, $date): Builder => $query->whereDate('requested_at', '<=', $date),
                            );
                    }),
                Filter::make('seen_at')
                    ->form([
                        DatePicker::make('seen_start'),
                        DatePicker::make('seen_end'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['seen_start'],
                                fn (Builder $query, $date): Builder => $query->whereDate('seen_at', '>=', $date),
                            )
                            ->when(
                                $data['seen_end'],
                                fn (Builder $query, $date): Builder => $query->whereDate('seen_at', '<=', $date),
                            );
                    }),
            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make(),
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
            'index' => Pages\ListInterviews::route('/'),
            'create' => Pages\CreateInterview::route('/create'),
            'view' => Pages\ViewInterview::route('/{record}'),
            'edit' => Pages\EditInterview::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
