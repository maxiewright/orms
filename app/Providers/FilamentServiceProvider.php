<?php

namespace App\Providers;

use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;

class FilamentServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {

        Page::$reportValidationErrorUsing = function (ValidationException $exception) {
            Notification::make()
                ->title($exception->getMessage())
                ->danger()
                ->send();
        };
    }
}
