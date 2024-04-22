<?php

namespace Modules\ServiceFund\App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ServiceFund\Database\factories\ReconciliationFactory;

class Reconciliation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'account_id',
        'started_at',
        'ended_at',
        'closing_balance_in_cents',
    ];

    protected $guarded = [
        'created_by',
    ];

    protected $casts = [
        'started_at' => 'datetime:Y-m-d H:i',
        'ended_at' => 'datetime:Y-m-d H:i',
        'closing_balance_in_cents' => 'integer',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Reconciliation $reconciliation) {
            $reconciliation->created_by = auth()->id();
        });
    }

    protected static function newFactory(): ReconciliationFactory
    {
        return ReconciliationFactory::new();
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function closingBalance(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->closing_balance_in_cents / 100,
            set: fn ($value) => $this->closing_balance_in_cents = $value * 100,
        );
    }
}
