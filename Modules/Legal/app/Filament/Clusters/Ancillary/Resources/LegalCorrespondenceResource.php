<?php

namespace Modules\Legal\Filament\Clusters\Ancillary\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Modules\Legal\Filament\Clusters\Ancillary;
use Modules\Legal\Filament\Clusters\Ancillary\Resources\LegalCorrespondenceResource\Pages;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondence;

class LegalCorrespondenceResource extends Resource
{
    protected static ?string $model = LegalCorrespondence::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Ancillary::class;

    public static function form(Form $form): Form
    {
        return $form->schema(LegalCorrespondence::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable()
                    ->sortable(),
                SpatieMediaLibraryImageColumn::make('correspondence')
                    ->collection('legal_correspondence')
                    ->conversion('thumb'),
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
            'index' => Pages\ListLegalCorrespondences::route('/'),
        ];
    }
}
