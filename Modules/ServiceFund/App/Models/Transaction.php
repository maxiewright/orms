<?php

namespace Modules\ServiceFund\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'amount',
        'payment_method',
        'transaction_category_id',
        'transactional_id',
        'transactional_type',
        'particulars',
        'approved_by',
        'approved_at',
        'created_by',
    ];

    /*
     * TODO - Add Enums for transaction type, payment method, transaction category an maybe add them
     *  to the cast array as well.
     */

    protected $casts = [
        'amount' => 'float',
        'executed_at' => 'datetime',
        'approved_at' => 'datetime',
        'type' => TransactionType::class,
        'payment_method' => PaymentMethod::class,
        'categories' => 'array',
    ];

    protected $with = [
        'transactional',
    ];

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
            table: 'transaction_transaction_category',
        )->withTimestamps();
    }

    public function transactional(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeDebit(Builder $query): void
    {
        $query->where('type', TransactionType::Debit);
    }

    public function scopeCredit(Builder $query): void
    {
        $query->where('type', TransactionType::Credit);
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
}
