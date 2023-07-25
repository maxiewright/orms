<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\Serviceperson;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Access Control';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('serviceperson_number')
                    ->relationship('serviceperson', 'number')
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->military_name}")
                    ->searchable(['number', 'first_name', 'last_name'])
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->reactive()
                    ->afterStateUpdated(function (\Closure $set, $state) {
                        $serviceperson = Serviceperson::query()->find($state);
                        $userName = $serviceperson->number.
                            Str::lower($serviceperson->last_name).
                            Str::lower(Str::substr($serviceperson->first_name, 0, 1));
                        $set('name', $userName);
                    }),
                Forms\Components\TextInput::make('name')
                    ->label('Username')
                    ->unique(ignoreRecord: true)
                    ->extraInputAttributes(['readonly' => true]),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->confirmed()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email_confirmation'),
                Forms\Components\Select::make('user.roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('serviceperson.military_name')
                    ->label('Name')
                    ->searchable(['number', 'first_name', 'last_name']),
                Tables\Columns\TextColumn::make('name')
                    ->label('username'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('roles.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
