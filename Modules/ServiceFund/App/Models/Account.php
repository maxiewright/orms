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
use Modules\ServiceFund\Enums\AccountTypeEnum;
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
        'bank_id',
        'opening_balance',
        'minimum_signatories',
        'maximum_signatories',
        'active_at',
    ];

    protected $casts = [
        'active_at' => 'datetime',
        'type' => AccountTypeEnum::class,
    ];

    protected $appends = [
        'active_since',
    ];

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

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
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
