<?php

namespace Modules\ServiceFund\App\Models;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Modules\ServiceFund\Database\factories\BankFactory;
use Modules\ServiceFund\Traits\SluggableByName;

class Bank extends Model
{
    use HasFactory;
    use SluggableByName;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address_line_1',
        'address_line_2',
        'city_id',
    ];

    protected $with = ['city'];

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

    public function city(): BelongsTo
    {
        return $this->belongsTo(app(config('servicefund.address.city'))::class, 'city_id');
    }

    public function address(): Attribute
    {
        return Attribute::make(
            get: fn () => ! $this->address_line_2
                ? $this->address_line_1.', '.$this->city?->name
                : $this->address_line_1.', '.$this->address_line_2.', '.$this->city?->name
        );
    }
}
