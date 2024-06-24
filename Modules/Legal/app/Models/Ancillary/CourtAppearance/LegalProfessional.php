<?php

namespace Modules\Legal\Models\Ancillary\CourtAppearance;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Legal\Database\Factories\LegalProfessionalFactory;
use Modules\Legal\Enums\LegalProfessionalType;
use Modules\Legal\Models\CourtAppearance;
use Modules\Legal\Models\LegalAction\LegalProfessionalPreActionProtocol;
use Modules\Legal\Models\LegalAction\PreActionProtocol;

class LegalProfessional extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
    ];

    protected $casts = [
        'type' => LegalProfessionalType::class,
    ];

    protected static function newFactory(): LegalProfessionalFactory
    {
        return LegalProfessionalFactory::new();
    }

    public function courtAppearance(): HasMany
    {
        return $this->hasMany(CourtAppearance::class);
    }

    public function preActionProtocols(): BelongsToMany
    {
        return $this->belongsToMany(PreActionProtocol::class, 'legal_professional_pre_action_protocol')
            ->using(LegalProfessionalPreActionProtocol::class)
            ->withTimestamps();
    }

    public static function getForm($type = null): array
    {
        return [
            Group::make()
                ->columns()
                ->columnSpanFull()
                ->schema([
                    Select::make('type')
                        ->options(LegalProfessionalType::class)
                        ->enum(LegalProfessionalType::class)
                        ->default($type)
                        ->required(),
                    TextInput::make('name')->required(),
                    TextInput::make('email')->email()->nullable(),
                    TextInput::make('phone')->nullable(),
                ]),
        ];
    }
}
