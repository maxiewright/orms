<?php

namespace Modules\Legal\Models\Ancillary;

use App\Traits\HasAddress;
use App\Traits\SluggableByName;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Legal\Database\Factories\JusticeInstitutionFactory;
use Modules\Legal\Enums\JusticeInstitutionType;

class JusticeInstitution extends Model
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
        'type',
        'address_line_1',
        'address_line_2',
        'division_id',
        'city_id',
    ];

    protected $casts = [
        'type' => JusticeInstitutionType::class,
    ];

    protected static function newFactory(): JusticeInstitutionFactory
    {
        return JusticeInstitutionFactory::new();
    }

    public static function getForm($type = null): array
    {
        return [
            Group::make()
                ->columns(3)
                ->schema([
                    Select::make('type')
                        ->options(JusticeInstitutionType::class)
                        ->enum(JusticeInstitutionType::class)
                        ->default($type)
                        ->required()
                        ->live(),
                    TextInput::make('name')
                        ->columnSpan(2)
                        ->required(),
                ]),
            Group::make()
                ->columns()
                ->schema([
                    TextInput::make('address_line_1')
                        ->placeholder('Enter the address')
                        ->required(),
                    TextInput::make('address_line_2')
                        ->placeholder('Enter the address'),
                    Select::make('division_id')
                        ->placeholder('Select a division')
                        ->relationship('division', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->live(),
                    Select::make('city_id')
                        ->placeholder(fn (Get $get) => $get('division_id') ? 'Select a city' : 'Select a division first')
                        ->relationship('city', 'name', modifyQueryUsing: function (Builder $query, Get $get) {
                            return $query->where('division_id', $get('division_id'));
                        })
                        ->searchable()
                        ->preload()
                        ->required(),
                ]),

        ];
    }
}
