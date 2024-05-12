<?php

namespace Modules\Legal\Filament\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Legal\Filament\Resources\CourtAttendenceResource\Pages;
use Modules\Legal\Models\CourtAppearance;

class CourtAppearanceResource extends Resource
{
    protected static ?string $model = CourtAppearance::class;

    protected static ?string $navigationGroup = 'Court';

    protected static ?int $navigationSort = 3;

    protected static ?string $label = 'Appearance';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
}
