<?php

namespace Modules\Legal\Filament\Resources;

use Modules\Legal\Filament\Resources\InterdicationResource\Pages;
use Modules\Legal\Filament\Resources\InterdicationResource\RelationManagers;
use Modules\Legal\Models\Interdiction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InterdictionResource extends Resource
{
    protected static ?string $model = Interdiction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 4;

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
            'index' => Pages\ListInterdications::route('/'),
            'create' => Pages\CreateInterdication::route('/create'),
            'edit' => Pages\EditInterdication::route('/{record}/edit'),
        ];
    }
}
