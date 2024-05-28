<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicepersonResource\Pages;
use App\Models\Serviceperson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ServicepersonResource extends Resource
{
    protected static ?string $model = Serviceperson::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Servicepeople';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Personal Information')
                            ->schema(Serviceperson::personalDataSchema())
                            ->columns(1),
                        Forms\Components\Tabs\Tab::make('Contact Information')
                            ->schema(Serviceperson::contactInformationSchema()),
                        Forms\Components\Tabs\Tab::make('Service Data')
                            ->schema(Serviceperson::serviceDataSchema()),
                        Forms\Components\Tabs\Tab::make('Emergency Contact')
                            ->schema(Serviceperson::emergencyContactSchema()),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(fn (Serviceperson $record) => route('filament.servicepeople.resources.servicepeople.view', $record))
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Photo')
                    ->circular(),
                Tables\Columns\TextColumn::make('military_name')
                    ->sortable(['rank_id', 'number'], query: fn ($query) => $query
                        ->orderBy('rank_id', 'desc')
                        ->orderBy('number'))
                    ->searchable(query: fn (Builder $query, $search) => Serviceperson::militaryNameSearch($query, $search))
                    ->label('Name'),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date('d M Y'),
                Tables\Columns\TextColumn::make('enlistmentType.name'),
                Tables\Columns\TextColumn::make('enlistment_date')
                    ->date('d M Y'),
                Tables\Columns\TextColumn::make('assumption_date')
                    ->date('d M Y'),
            ])
            ->defaultSort(fn ($query) => $query
                ->orderBy('rank_id', 'desc')
                ->orderBy('number')
            )
            ->filters([
                Tables\Filters\SelectFilter::make('rank')
                    ->relationship('rank', 'regiment_abbreviation')
                    ->multiple(),
                Tables\Filters\SelectFilter::make('enlistment_type')
                    ->relationship('enlistmentType', 'name')
                    ->multiple(),
                Tables\Filters\SelectFilter::make('gender')
                    ->relationship('gender', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServicepeople::route('/'),
            'create' => Pages\CreateServiceperson::route('/create'),
            'view' => Pages\ViewServiceperson::route('/{record}'),
            'edit' => Pages\EditServiceperson::route('/{record}/edit'),
        ];
    }
}
