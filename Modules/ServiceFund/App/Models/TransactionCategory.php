<?php

namespace Modules\ServiceFund\App\Models;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Modules\ServiceFund\Traits\SluggableByName;

class TransactionCategory extends Model
{
    use SluggableByName;

    protected $fillable = [
        'name',
        'description',
    ];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Str::ucwords($value),
            set: fn ($value) => Str::lower($value),
        );
    }

    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Transaction::class,
            table: 'transaction_transaction_category'
        )
            ->withTimestamps();
    }

    public static function getForm(): array
    {
        return [
            TextInput::make('name')
                ->required(),
            Textarea::make('description')
                ->required(),
        ];
    }
}
