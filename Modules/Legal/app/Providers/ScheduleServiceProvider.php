<?php

namespace Modules\Legal\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Modules\Legal\Jobs\ProcessImminentAndDefaultedPreActionProtocols;

class ScheduleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->job(new ProcessImminentAndDefaultedPreActionProtocols())->everyMinute();
        });
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {

    }
}
