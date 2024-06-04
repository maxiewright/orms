<?php

namespace Modules\Legal\Models\LegalAction;

use App\Traits\HasAddress;
use App\Traits\SluggableByName;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Legal\Database\Factories\LegalAction\DefendantFactory;

class Defendant extends Model
{
    use HasAddress;
    use HasFactory;
    use SluggableByName;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'abbreviation',
        'address_line_1',
        'address_line_2',
        'division_id',
        'city_id',
        'particulars',
    ];

    protected static function newFactory(): DefendantFactory
    {
        return DefendantFactory::new();
    }

    public static function getForm($type = null): array
    {
        return [
            Group::make()
                ->columns()
                ->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('abbreviation'),
                ]),
            Group::make()
                ->columns()
                ->schema([
                    TextInput::make('address_line_1')
                        ->placeholder('Enter the address'),
                    TextInput::make('address_line_2')
                        ->placeholder('Enter the address'),
                    Select::make('division_id')
                        ->placeholder('Select a division')
                        ->relationship('division', 'name')
                        ->searchable()
                        ->preload()
                        ->live(),
                    Select::make('city_id')
                        ->placeholder(fn (Get $get) => $get('division_id') ? 'Select a city' : 'Select a division first')
                        ->relationship('city', 'name', modifyQueryUsing: function (Builder $query, Get $get) {
                            return $query->where('division_id', $get('division_id'));
                        })
                        ->searchable()
                        ->preload(),
                ]),
            RichEditor::make('particulars')
                ->columnSpanFull(),

        ];
    }
}
