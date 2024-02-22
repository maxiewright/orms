<?php

namespace Modules\ServiceFund\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ServiceFund\Database\factories\TransactionFactory;
use Modules\ServiceFund\Enums\PaymentMethodEnum;
use Modules\ServiceFund\Enums\TransactionTypeEnum;
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
        'description',
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
        'type' => TransactionTypeEnum::class,
        'payment_method' => PaymentMethodEnum::class,
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(TransactionCategory::class, 'transaction_category_id');
    }

    public function transactional(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeDebit(Builder $query): void
    {
        $query->where('type', TransactionTypeEnum::Debit);
    }

    public function scopeCredit(Builder $query): void
    {
        $query->where('type', TransactionTypeEnum::Credit);
    }

    public function scopeTransfer(Builder $query): void
    {
        $query->where('type', TransactionTypeEnum::Transfer);

    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(app(config('servicefund.user.model'))::class, 'approved_by', 'number');
    }
}
