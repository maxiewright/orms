<?php

namespace Modules\Legal\Filament\Resources;

use Modules\Legal\Filament\Resources\CourtAttendenceResource\Pages;
use Modules\Legal\Filament\Resources\CourtAttendenceResource\RelationManagers;
use Modules\Legal\Models\CourtAttendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourtAttendenceResource extends Resource
{
    protected static ?string $model = CourtAttendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            'index' => Pages\ListCourtAttendences::route('/'),
            'create' => Pages\CreateCourtAttendence::route('/create'),
            'edit' => Pages\EditCourtAttendence::route('/{record}/edit'),
        ];
    }
}
