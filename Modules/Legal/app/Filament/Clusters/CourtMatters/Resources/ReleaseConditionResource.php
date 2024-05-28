<?php

namespace Modules\Legal\Filament\Clusters\CourtMatters\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Legal\Filament\Clusters\CourtMatters;
use Modules\Legal\Filament\Clusters\CourtMatters\Resources\ReleaseConditionResource\Pages;
use Modules\Legal\Models\Ancillary\CourtAppearance\ReleaseCondition;

class ReleaseConditionResource extends Resource
{
    protected static ?string $model = ReleaseCondition::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = CourtMatters::class;

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
            'index' => Pages\ManageReleaseConditions::route('/'),
        ];
    }
}
