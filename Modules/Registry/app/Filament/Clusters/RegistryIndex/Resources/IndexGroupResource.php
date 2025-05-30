<?php

namespace Modules\Registry\Filament\Clusters\RegistryIndex\Resources;

use Modules\Registry\Filament\Clusters\RegistryIndex;
use Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexGroupResource\Pages;
use Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexGroupResource\RelationManagers;
use Modules\Registry\Models\RegistryIndex\IndexGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IndexGroupResource extends Resource
{
    protected static ?string $model = IndexGroup::class;


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('Group');
    }

    protected static ?string $cluster = RegistryIndex::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            RelationManagers\SubGroupsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIndexGroups::route('/'),
            'create' => Pages\CreateIndexGroup::route('/create'),
            'edit' => Pages\EditIndexGroup::route('/{record}/edit'),
        ];
    }
}
