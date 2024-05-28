<?php

namespace Modules\Legal\Filament\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Legal\Filament\Resources\LitigationResource\Pages;
use Modules\Legal\Models\Litigation;

class LitigationResource extends Resource
{
    protected static ?string $model = Litigation::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Legal Actions';

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
            'index' => Pages\ListLitigation::route('/'),
            'create' => Pages\CreateLitigation::route('/create'),
            'edit' => Pages\EditLitigation::route('/{record}/edit'),
        ];
    }
}
