<?php

namespace Modules\ServiceFund\App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Number;
use Modules\ServiceFund\Database\factories\TransferFactory;

class Transfer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'credit_transaction_id',
        'debit_transaction_id',
        'transferred_at',
    ];

    protected $casts = [
        'transferred_at' => 'datetime:Y-m-d H:i',
    ];

    protected $with = [
        'debitTransaction',
        'creditTransaction',
    ];

    protected $appends = [
        'amount',
        'payment_method',
        'remitter',
    ];

    protected static function newFactory(): TransferFactory
    {
        return TransferFactory::new();
    }

    public function debitTransaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'debit_transaction_id');
    }

    public function creditTransaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'credit_transaction_id');
    }

    public function debitAccount(): HasOneThrough
    {
        return $this->account('debit_transaction_id');
    }

    public function creditAccount(): HasOneThrough
    {
        return $this->account('credit_transaction_id');
    }

    public function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->debitTransaction->amount_in_cents / 100,
        );
    }

    public function paymentMethod(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->debitTransaction->payment_method
        );
    }

    public function remitter(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->debitTransaction->transactional->name
        );
    }

    private function account($localKey): HasOneThrough
    {
        return $this->hasOneThrough(
            related: Account::class,
            through: Transaction::class,
            firstKey: 'id',
            secondKey: 'id',
            localKey: $localKey,
            secondLocalKey: 'account_id'
        );
    }
}
