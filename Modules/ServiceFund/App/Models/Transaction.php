<?php

namespace Modules\ServiceFund\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ServiceFund\Database\factories\TransactionFactory;
use Modules\ServiceFund\Enums\PaymentMethod;
use Modules\ServiceFund\Enums\TransactionType;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Transaction extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'account_id',
        'type',
        'executed_at',
        'amount_in_cents',
        'payment_method',
        'transaction_category_id',
        'transactional_id',
        'transactional_type',
        'particulars',
        'approved_by',
        'approved_at',
    ];

    protected $guarded = [
        'reconciliation_id',
        'created_by',
    ];

    protected $casts = [
        'amount_in_cents' => 'integer',
        'amount' => 'float',
        'executed_at' => 'datetime',
        'approved_at' => 'datetime:Y-m-d H:i',
        'type' => TransactionType::class,
        'payment_method' => PaymentMethod::class,
        'categories' => 'array',
    ];

    protected $with = [
        'transactional',
    ];

    protected $appends = [
        'amount',
        'execution_date',
        'reconciled',
    ];

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function (Transaction $transaction) {
            $transaction->created_by = auth()->id();
        });
    }

    protected static function newFactory(): TransactionFactory
    {
        return TransactionFactory::new();
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            related: TransactionCategory::class,
            table: 'transaction_category',
        )->withTimestamps();
    }

    public function transactional(): MorphTo
    {
        return $this->morphTo();
    }

    public function amount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->amount_in_cents / 100,
            set: fn ($value) => $this->amount_in_cents = $value * 100,
        );
    }

    public function executionDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->executed_at->format('Y-m-d'),
        );
    }

    public function debitTransfers(): HasMany
    {
        return $this->hasMany(Transfer::class, 'debit_transaction_id');
    }

    public function creditTransfers(): HasMany
    {
        return $this->hasMany(Transfer::class, 'credit_transaction_id');
    }

    public function scopeDebit(Builder $query): void
    {
        $query->where('type', TransactionType::Debit);
    }

    public function scopeCredit(Builder $query): void
    {
        $query->where('type', TransactionType::Credit);
    }

    public function scopeTransfer(Builder $query): void
    {
        $query->where('type', TransactionType::DebitTransfer)
            ->orWhere('type', TransactionType::CreditTransfer);
    }

    public function scopeDebitTransfer(Builder $query): void
    {
        $query->where('type', TransactionType::DebitTransfer);

    }

    public function scopeCreditTransfer(Builder $query): void
    {
        $query->where('type', TransactionType::CreditTransfer);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(app(config('servicefund.user.model'))::class, 'approved_by', 'number');
    }

    public function reconciliation(): BelongsTo
    {
        return $this->belongsTo(Reconciliation::class);
    }

    public function reconciled(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->reconciliation()->exists()
        );
    }
}
