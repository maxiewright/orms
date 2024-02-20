<?php

namespace Modules\ServiceFund\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\ServiceFund\Contracts\TransactionLookupInterface;
use Modules\ServiceFund\Traits\InteractsWithTransactions;
use Modules\ServiceFund\Traits\SluggableByName;

class TransactionCategory extends Model implements TransactionLookupInterface
{
    use InteractsWithTransactions;
    use SluggableByName;

    protected $fillable = [];

    public static function getForm(): array
    {
        // TODO - Build the form
        return [

        ];
    }
}
