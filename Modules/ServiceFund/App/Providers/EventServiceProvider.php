<?php

namespace Modules\ServiceFund\App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\ServiceFund\App\Events\TransactionCreated;
use Modules\ServiceFund\App\Events\TransferCompleted;
use Modules\ServiceFund\App\Listeners\SendTransactionNotification;
use Modules\ServiceFund\App\Listeners\SendTransferCompletedNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TransactionCreated::class => [
            SendTransactionNotification::class,
        ],
        TransferCompleted::class => [
            SendTransferCompletedNotification::class,
        ],
    ];

}
