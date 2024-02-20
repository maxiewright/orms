<?php

namespace Modules\ServiceFund\App\Models;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Modules\ServiceFund\Database\factories\BankFactory;
use Modules\ServiceFund\Traits\SluggableByName;

class Bank extends Model
{
    use HasFactory;
    use SluggableByName;

    protected $fillable = [];

    protected static function newFactory(): BankFactory
    {
        return BankFactory::new();
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    public static function getForm(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
        ];
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Str::ucwords($value),
            set: fn ($value) => Str::lower($value),
        );
    }
}
