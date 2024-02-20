<?php

namespace Modules\ServiceFund\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\ServiceFund\App\Models\Account;
use Modules\ServiceFund\App\Models\AccountSignatory;

trait IsSignatory
{
    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Account::class,
            table: 'account_signatories',
            foreignPivotKey: 'signatory_id',
            relatedPivotKey: 'account_id',
        )
            ->using(AccountSignatory::class)
            ->withPivot('active_from', 'inactive_from', 'particulars')
            ->withTimestamps();
    }
}
