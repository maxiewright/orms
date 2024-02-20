<?php

namespace Modules\ServiceFund\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\ServiceFund\Database\factories\AccountSignatoryFactory;

class AccountSignatory extends Pivot
{
    use HasFactory;

    protected $table = 'account_signatories';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'account_id',
        'signatory_id',
        'active_from',
        'inactive_from',
        'particulars',
    ];

    protected $casts = [
        'active_from' => 'datetime',
        'inactive_from' => 'datetime',
    ];

    protected static function newFactory(): AccountSignatoryFactory
    {
        return AccountSignatoryFactory::new();
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function signatory(): BelongsTo
    {
        return $this->belongsTo(app(config('servicefund.user.model'))::class, 'signatory_id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->whereNotNull('active_from')
            ->whereNull('inactive_from');
    }

    public function scopeInactive(Builder $query)
    {
        $query->whereNotNull('inactive_from');
    }
}
