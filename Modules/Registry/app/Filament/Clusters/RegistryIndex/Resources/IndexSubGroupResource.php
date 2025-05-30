<?php

namespace Modules\Registry\Filament\Clusters\RegistryIndex\Resources;

use Modules\Registry\Filament\Clusters\RegistryIndex;
use Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexSubGroupResource\Pages;
use Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexSubGroupResource\RelationManagers;
use Modules\Registry\Models\RegistryIndex\IndexSubGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IndexSubGroupResource extends Resource
{
    protected static ?string $model = IndexSubGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $cluster = RegistryIndex::class;

    public static function getModelLabel(): string
    {
        return __('Subgroup');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('reference_number')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('index_group_id')
                    ->relationship('indexGroup', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference_number')
                    ->label(__('Reference Number'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('indexGroup.name')
                    ->label(__('Group'))
                    ->searchable()
                    ->sortable(),

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
                Tables\Filters\SelectFilter::make('index_group_id')
                    ->relationship('indexGroup', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->placeholder('Select Group'),
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
            RelationManagers\SubjectsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIndexSubGroups::route('/'),
            'create' => Pages\CreateIndexSubGroup::route('/create'),
            'edit' => Pages\EditIndexSubGroup::route('/{record}/edit'),
        ];
    }
}
