<?php

namespace Modules\ServiceFund\App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\ServiceFund\App\Events\TransactionCreated;
use Modules\ServiceFund\App\Listeners\SendTransactionNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TransactionCreated::class => [
            SendTransactionNotification::class,
        ],
    ];

}
