<?php

namespace Modules\Legal\Models;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Legal\Database\Factories\ChargeFactory;
use Modules\Legal\Enums\JusticeInstitutionType;
use Modules\Legal\Enums\OffenceType;
use Modules\Legal\Models\Ancillary\Infraction\OffenceDivision;
use Modules\Legal\Models\Ancillary\Infraction\OffenceSection;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondence;
use Modules\Legal\Models\Ancillary\JusticeInstitution;

class Charge extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'infraction_id',
        'offence_type',
        'offence_division_id',
        'offence_section_id',
        'charged_at',
        'justice_institution_id',
        'charged_by',
    ];

    protected $casts = [
        'charged_at' => 'datetime',
        'offence_type' => OffenceType::class,
    ];

    protected static function newFactory(): ChargeFactory
    {
        return ChargeFactory::new();
    }

    public function infraction(): BelongsTo
    {
        return $this->belongsTo(Infraction::class);
    }

    public function offenceDivision(): BelongsTo
    {
        return $this->belongsTo(OffenceDivision::class, 'offence_division_id');
    }

    public function offenceSection(): BelongsTo
    {
        return $this->belongsTo(OffenceSection::class, 'offence_section_id');
    }

    public function policeStation(): BelongsTo
    {
        return $this->belongsTo(JusticeInstitution::class, 'justice_institution_id');
    }

    public function references(): MorphToMany
    {
        return $this->morphToMany(LegalCorrespondence::class, 'referenceable');
    }

    public static function getForm(): array
    {
        return [
            Select::make('offence_type')
                ->label('Offence Type')
                ->options(OffenceType::class)
                ->enum(OffenceType::class)
                ->live()
                ->required()
                ->afterStateUpdated(function (Set $set) {
                    $set('offence_division_id', null);
                    $set('offence_section_id', null);
                }),
            Select::make('offence_division_id')
                ->label('Offence Division')
                ->placeholder('Select Division')
                ->options(fn (Get $get) => OffenceDivision::query()
                    ->where('type', $get('offence_type'))
                    ->pluck('name', 'id'))
                ->live()
                ->afterStateUpdated(fn (Set $set) => $set('offence_section_id', null))
                ->searchable()
                ->preload()
                ->required(),
            Select::make('offence_section_id')
                ->label('Offence Section')
                ->placeholder(fn (Get $get) => empty($get('offence_division_id')) ? 'Select Offence Division First' : 'Select Offence')
                ->options(fn (Get $get) => OffenceSection::query()
                    ->where('offence_division_id', $get('offence_division_id'))
                    ->pluck('name', 'id'))
                ->live()
                ->searchable()
                ->preload()
                ->required(),
            DateTimePicker::make('charged_at')
                ->label('Date Charged')
                ->required()
                ->before('now')
                ->seconds(false),
            Select::make('justice_institution_id')
                ->label('Police Station')
                ->relationship(
                    name: 'policeStation',
                    titleAttribute: 'name',
                    modifyQueryUsing: function (Builder $query) {
                        return $query->where('type', 'police station');
                    }
                )
                ->createOptionForm(JusticeInstitution::getForm(type: JusticeInstitutionType::PoliceStation))
                ->required(),
            TextInput::make('charged_by')
                ->label('Charged By')
                ->required(),
            Select::make('references')
                ->relationship('references', 'name')
                ->createOptionForm(LegalCorrespondence::getForm())
                ->label('Reference Documents')
                ->columnSpanFull()
                ->multiple(),

        ];
    }
}
