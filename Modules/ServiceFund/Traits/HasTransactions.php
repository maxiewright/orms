<?php

namespace Modules\ServiceFund\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\ServiceFund\App\Models\Transaction;

trait HasTransactions
{
    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactional');
    }
}
