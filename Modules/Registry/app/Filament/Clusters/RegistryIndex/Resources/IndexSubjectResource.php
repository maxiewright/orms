<?php

namespace Modules\Registry\Filament\Clusters\RegistryIndex\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Modules\Registry\Filament\Clusters\RegistryIndex;
use Modules\Registry\Filament\Clusters\RegistryIndex\Resources\IndexSubjectResource\Pages;
use Modules\Registry\Models\RegistryIndex\IndexSubject;

class IndexSubjectResource extends Resource
{
    protected static ?string $model = IndexSubject::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = RegistryIndex::class;

    public static function getModelLabel(): string
    {
        return __('Subject');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('reference_number')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Forms\Components\Select::make('index_group_id')
                    ->relationship('indexGroup', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->live(),

                Forms\Components\Select::make('index_sub_group_id')
                    ->relationship('indexSubGroup', 'name',
                        modifyQueryUsing: function (Builder $query, array $data) {
                            return $query->where('index_group_id', $data['index_group_id']);
                        })
                    ->required()
                    ->searchable()
                    ->preload(),

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
                Tables\Columns\TextColumn::make('reference_number')
                    ->label(__('Reference Number'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('indexGroup.name')
                    ->label(__('Group'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('indexSubGroup.name')
                    ->label(__('Sub Group'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('Subject'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Updated At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('index_group_id')
                    ->label(__('Group'))
                    ->relationship('indexGroup', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->placeholder('Select Group'),

                Tables\Filters\SelectFilter::make('index_sub_group_id')
                    ->label(__('Sub Group'))
                    ->relationship('indexSubGroup', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->placeholder('Select Subgroup'),
            ], Tables\Enums\FiltersLayout::AboveContent)
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
            // No relation managers needed for IndexSubject
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIndexSubjects::route('/'),
            'create' => Pages\CreateIndexSubject::route('/create'),
            'edit' => Pages\EditIndexSubject::route('/{record}/edit'),
        ];
    }
}
