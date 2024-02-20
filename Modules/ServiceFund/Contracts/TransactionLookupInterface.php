<?php

namespace Modules\ServiceFund\Contracts;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface TransactionLookupInterface
{
    public function transactions(): HasMany;

    public function name(): Attribute;
}
