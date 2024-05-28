<?php

namespace Modules\Legal\Models;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Legal\Database\Factories\ChargeFactory;
use Modules\Legal\Enums\Incident\OffenceType;
use Modules\Legal\Enums\JusticeInstitutionType;
use Modules\Legal\Models\Ancillary\Infraction\OffenceDivision;
use Modules\Legal\Models\Ancillary\Infraction\OffenceSection;
use Modules\Legal\Models\Ancillary\JusticeInstitution;
use Modules\Legal\traits\HasReferences;

class Charge extends Model
{
    use HasFactory;
    use HasReferences;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'incident_id',
        'offence_type',
        'offence_division_id',
        'offence_section_id',
        'charged_at',
        'justice_institution_id',
        'charged_by',
        'particulars',
    ];

    protected $casts = [
        'charged_at' => 'datetime:Y-m-d H:i',
        'offence_type' => OffenceType::class,
    ];

    protected $with = [
        'offenceDivision', 'offenceSection', 'policeStation',
    ];

    protected static function newFactory(): ChargeFactory
    {
        return ChargeFactory::new();
    }

    public function incident(): BelongsTo
    {
        return $this->belongsTo(Incident::class);
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
        return $this->belongsTo(JusticeInstitution::class, 'justice_institution_id')
            ->where('type', JusticeInstitutionType::PoliceStation);
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
                ->after('../../occurred_at')
                ->seconds(false),
            Select::make('justice_institution_id')
                ->label('Police Station')
                ->options(function (?Charge $record, Get $get, Set $set) {
                    if (! empty($record)) {
                        $set('justice_institution_id', $record->justice_institution_id);
                    }

                    return JusticeInstitution::query()
                        ->where('type', 'police station')
                        ->get()
                        ->pluck('name', 'id');
                })
                ->createOptionForm(JusticeInstitution::getForm(type: JusticeInstitutionType::PoliceStation))
                ->required(),
            TextInput::make('charged_by')
                ->label('Charged By'),
            self::getReferences()->columnSpanFull(),
            RichEditor::make('particulars')
                ->columnSpanFull(),

        ];
    }
}
