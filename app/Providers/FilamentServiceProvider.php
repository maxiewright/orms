<?php

namespace App\Providers;

use App\Filament\Pages\MyProfile;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
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
                    ->uncompromised(3)
            ]
        );

        Filament::registerNavigationGroups([
            'servicepeople',
            'officers',
            'access control'
        ]);
    }
}
