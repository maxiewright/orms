<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use JeffGreco13\FilamentBreezy\FilamentBreezy;

class FilamentServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {

        Filament::serving(function () {
            Filament::registerViteTheme('resources/css/filament.css');
        });

        FilamentBreezy::setPasswordRules(
            [
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->mixedCase()
                    ->uncompromised(3),
            ]
        );

        Filament::registerNavigationGroups([
            'servicepeople',
            'officers',
            'administration',
            NavigationGroup::make('metadata')->collapsed(),
            NavigationGroup::make('access control')->collapsed(),

        ]);

        Page::$reportValidationErrorUsing = function (ValidationException $exception) {
            Notification::make()
                ->title($exception->getMessage())
                ->danger()
                ->send();
        };
    }
}
