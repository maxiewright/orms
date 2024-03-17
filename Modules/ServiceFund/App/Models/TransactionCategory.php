<?php

namespace Modules\ServiceFund\App\Models;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Modules\ServiceFund\Database\Factories\TransactionCategoryFactory;
use Modules\ServiceFund\Traits\SluggableByName;

class TransactionCategory extends Model
{
    use HasFactory;
    use SluggableByName;
    use SoftDeletes;

    protected static function newFactory(): TransactionCategoryFactory
    {
        return TransactionCategoryFactory::new();
    }

    protected $fillable = [
        'name',
        'description',
        'parent_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            related: TransactionCategory::class,
            foreignKey: 'parent_id',
        );
    }

    public function categories(): HasMany
    {
        return $this->hasMany(
            related: TransactionCategory::class,
            foreignKey: 'parent_id',
        );
    }

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
            table: 'transaction_category'
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
