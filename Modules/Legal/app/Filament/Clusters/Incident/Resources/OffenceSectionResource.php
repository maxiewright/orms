<?php

namespace Modules\Legal\Filament\Clusters\Incident\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Legal\Filament\Clusters\Incident;
use Modules\Legal\Filament\Clusters\Incident\Resources\OffenceSectionResource\Pages;
use Modules\Legal\Models\Ancillary\Infraction\OffenceSection;

class OffenceSectionResource extends Resource
{
    protected static ?string $model = OffenceSection::class;

    protected static ?string $cluster = Incident::class;

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
            'index' => Pages\ManageOffenceSections::route('/'),
        ];
    }
}
