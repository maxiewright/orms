<?php

namespace Modules\ServiceFund\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ServiceFund\Contracts\TransactionLookupInterface;
use Modules\ServiceFund\Database\factories\AccountFactory;
use Modules\ServiceFund\Enums\AccountType;
use Modules\ServiceFund\Traits\InteractsWithTransactions;
use Modules\ServiceFund\Traits\SluggableByName;

class Account extends Model implements TransactionLookupInterface
{
    use HasFactory;
    use InteractsWithTransactions;
    use SluggableByName;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'company_id',
        'type',
        'name',
        'slug',
        'number',
        'bank_branch_id',
        'opening_balance_in_cents',
        'minimum_signatories',
        'maximum_signatories',
        'active_at',
    ];

    protected $casts = [
        'balance' => 'float',
        'debits' => 'float',
        'credits' => 'float',
        'active_at' => 'datetime',
        'type' => AccountType::class,
        'opening_balance' => 'integer',
    ];

    protected $appends = [
        'active_since',
        'debits',
        'credits',
        'balance',
    ];

    protected $with = [
        'transactions',
        'bankBranch',
    ];

    public function openingBalance(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->opening_balance_in_cents / 100,
            set: fn ($value) => $this->opening_balance_in_cents = $value * 100,
        );
    }

    public function debits(): Attribute
    {
        $debitSum = $this->transactions()->debit()->sum('amount_in_cents');
        $debitTransferSum = $this->transactions()->debitTransfer()->sum('amount_in_cents');

        return Attribute::make(
            get: fn () => ($debitSum + $debitTransferSum) / 100,
        );

    }

    public function credits(): Attribute
    {
        $creditSum = $this->transactions()->credit()->sum('amount_in_cents');
        $creditTransferSum = $this->transactions()->creditTransfer()->sum('amount_in_cents');

        return Attribute::make(
            get: fn () => ($creditSum + $creditTransferSum) / 100,
        );
    }

    public function balance(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->opening_balance + ($this->debits - $this->credits),
        );
    }

    public function balanceAt($date): float
    {

        $debitsToDate = $this->transactions()->debit()->debitTransfer()
            ->whereDate('executed_at', '<=', $date)
            ->sum('amount_in_cents');

        $creditsToDate = $this->transactions()->credit()->creditTransfer()
            ->whereDate('executed_at', '<=', $date)
            ->sum('amount_in_cents');

        return ($this->opening_balance_in_cents + ($debitsToDate - $creditsToDate)) / 100;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function newFactory(): AccountFactory
    {
        return AccountFactory::new();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(
            app(config('servicefund.company.model'))::class,
            config('servicefund.company.id')
        );
    }

    public function bankBranch(): BelongsTo
    {
        return $this->belongsTo(BankBranch::class);
    }

    public function signatories(): BelongsToMany
    {
        return $this->belongsToMany(
            related: app(config('servicefund.user.model'))::class,
            table: 'account_signatories',
            foreignPivotKey: 'account_id',
            relatedPivotKey: 'signatory_id'
        )
            ->using(AccountSignatory::class)
            ->withPivot(['active_from', 'inactive_from', 'particulars'])
            ->withTimestamps();
    }

    public function scopeActive(Builder $query): void
    {
        $query->whereNotNull('active_at');
    }

    public function inactive(Builder $query): void
    {
        $query->whereNull('active_at');
    }

    public function activeSince(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->active_at->format(config('servicefund.timestamp.date')),
        );
    }

    /**
     * @throws \ReflectionException
     */
    public static function getCompanyName(): string
    {
        return (new \ReflectionClass(config('servicefund.company.model')))
            ->getShortName();
    }

    public static function getCompanyTitleAttribute(): string
    {
        return config('servicefund.company.title-attribute');
    }
}
