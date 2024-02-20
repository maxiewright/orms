<?php

namespace Modules\ServiceFund\Filament\App\Resources;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\ServiceFund\App\Models\Contact;
use Modules\ServiceFund\Filament\App\Resources\ContactResource\Pages;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Basic Info')
                    ->schema([
                        TextInput::make('name')
                            ->columnSpanFull()
                            ->helperText('Enter full name of person or organisation')
                            ->required(),
                        TextInput::make('phone')
                            ->required(),
                        TextInput::make('email')
                            ->email(),
                        TextInput::make('website')
                            ->url(),
                    ])->columns(3),

                Section::make('Address')
                    ->schema([
                        TextInput::make('address_line_1')
                            ->columnSpanFull(),
                        TextInput::make('address_line_2')
                            ->columnSpanFull(),
                        Select::make('city_id')
                            ->relationship(name: \Modules\ServiceFund\App\Models\Contact::getCityModelName(), titleAttribute: 'name')
                            ->searchable(),
                    ]),
                Section::make('particulars')
                    ->schema([
                        Textarea::make('particulars')
                            ->helperText('Add any other information that is relevant to note about this contact')
                            ->columnSpanFull(),
                        Checkbox::make('is_active')
                            ->required()
                            ->default(true),
                    ]),

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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
