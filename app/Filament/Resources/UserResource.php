<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\Serviceperson;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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
                    ->afterStateUpdated(function (Set $set, $state) {
                        if ($state) {
                            $serviceperson = Serviceperson::query()->find($state);
                            $firstName = Str::of($serviceperson->first_name)->lower()->replace(' ', '');
                            $lastName = Str::of($serviceperson->last_name)->lower()->replace(' ', '');
                            $userName = $serviceperson->number.$lastName.Str::substr($firstName, 0, 1);

                            $set('name', trim($userName));
                            $set('email', $firstName.'.'.$lastName.'@ttdf.mil.tt');

                            return;
                        }

                        $set('name', '');
                        $set('email', '');
                    }),
                Forms\Components\TextInput::make('name')
                    ->label('Username')
                    ->unique(ignoreRecord: true)
                    ->extraInputAttributes(['readonly' => true]),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->confirmed(fn (?User $record, $state) => ! $record || $record->email !== $state)
                    ->maxLength(255)
                    ->live(),
                Forms\Components\TextInput::make('email_confirmation')
                    ->hidden(fn (?User $record, Forms\Get $get) => $record && ($record->email === $get('email')))
                    ->live(),
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
