<?php

namespace Modules\ServiceFund\App\Models;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ServiceFund\Database\factories\BankBranchFactory;
use Modules\ServiceFund\Traits\HasAddress;

class BankBranch extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasAddress;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'bank_id',
        'email',
        'phone',
        'is_head_office',
        'address_line_1',
        'address_line_2',
        'city_id',
    ];

    protected $casts = [
        'is_head_office' => 'boolean',
    ];

    protected $with = [
        'bank',
        'city',
    ];

    protected $appends = [
        'name',
        'address',
    ];

    protected static function newFactory(): BankBranchFactory
    {
        return BankBranchFactory::new();
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->bank->name} - {$this->address_line_1}, {$this->city->name}"
        );
    }

    public static function getForm(): array
    {
        return [
            Group::make([
                // Basic Information
                Select::make('bank_id')
                    ->helperText('If the bank is not listed, please click the plus icon to add it first.')
                    ->createOptionForm(Bank::getForm())
                    ->relationship('bank', 'name')
                    ->columnSpanFull()
                    ->label('Bank')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('email')
                    ->email(),
                TextInput::make('phone'),
                Checkbox::make('is_head_office')
                    ->label('Is Head Office?')
                    ->default(false),
            ])->columns(),
            // Address Information
            Group::make([
                TextInput::make('address_line_1')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('address_line_2')
                    ->columnSpanFull(),
                Select::make('city_id')
                    ->required()
                    ->relationship('city', 'name')
                    ->placeholder('Select City')
                    ->columnSpan(1)
                    ->searchable(),
            ])->columns(),
        ];
    }
}
