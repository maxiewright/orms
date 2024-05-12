<?php

namespace Modules\Legal\Filament\Resources;

use Modules\Legal\Filament\Resources\LegalActionResource\Pages;
use Modules\Legal\Filament\Resources\LegalActionResource\RelationManagers;
use Modules\Legal\Models\LegalAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LegalActionResource extends Resource
{
    protected static ?string $model = LegalAction::class;

    protected static ?string $navigationIcon = 'icon-agreement';

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
            'index' => Pages\ListLegalActions::route('/'),
            'create' => Pages\CreateLegalAction::route('/create'),
            'edit' => Pages\EditLegalAction::route('/{record}/edit'),
        ];
    }
}
