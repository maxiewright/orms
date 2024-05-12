<?php

namespace Modules\Legal\Providers\Filament;

use App\Actions\ChangePasswordAction;
use Coolsam\Modules\ModulesPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use RalphJSmit\Filament\Onboard\Http\Middleware\OnboardMiddleware;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;

class LegalPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('legal')
            ->path('legal')
            ->login()
            ->emailVerification()
            ->sidebarFullyCollapsibleOnDesktop()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->navigationGroups([
                NavigationGroup::make('Court')
                    ->icon('heroicon-o-building-library'),
            ])
            ->navigationItems([
                NavigationItem::make('Home')
                    ->icon('heroicon-o-home')
                    ->url(url('/admin/servicepeople')),
            ])
            ->discoverResources(in: app_path('Filament/Legal/Resources'), for: 'App\\Filament\\Legal\\Resources')
            ->discoverPages(in: app_path('Filament/Legal/Pages'), for: 'App\\Filament\\Legal\\Pages')
            ->pages([])
            ->discoverWidgets(in: app_path('Filament/Legal/Widgets'), for: 'App\\Filament\\Legal\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                OnboardMiddleware::class,
            ])->plugins([
                ModulesPlugin::make(),
                FilamentApexChartsPlugin::make(),
                BreezyCore::make()->myProfile(),
                ChangePasswordAction::make(),
                FilamentFullCalendarPlugin::make()
                    ->selectable()
                    ->editable()
                    ->timezone('america/port_of_spain'),
            ]);
    }
}
