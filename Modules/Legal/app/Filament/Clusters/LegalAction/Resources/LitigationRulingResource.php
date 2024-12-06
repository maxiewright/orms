<?php

namespace Modules\Legal\Filament\Clusters\LegalAction\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Legal\Filament\Clusters\LegalAction;
use Modules\Legal\Filament\Clusters\LegalAction\Resources\LitigationRulingResource\Pages;
use Modules\Legal\Models\Ancillary\Litigation\LitigationCategory;

class LitigationRulingResource extends Resource
{
    protected static ?string $model = LitigationCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = LegalAction::class;

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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLitigationRulings::route('/'),
        ];
    }
}
