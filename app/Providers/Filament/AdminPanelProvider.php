<?php

namespace App\Providers\Filament;

use App\Actions\ChangePasswordAction;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
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

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->brandName('ORMS - Servicepeople')
            ->id('servicepeople')
//            ->path('/admin')
            ->domain(app()->isProduction() ? 'servicepeople.orms.app' : 'servicepeople.orms.test')
            ->login()
            ->emailVerification()
            ->sidebarFullyCollapsibleOnDesktop()
            ->navigationGroups([
                NavigationGroup::make()->label('Servicepeople'),
                NavigationGroup::make()->label('Officers'),
                NavigationGroup::make()->label('Administration'),
                NavigationGroup::make()->label('Metadata')->collapsed(),
                NavigationGroup::make()->label('Access Control')->collapsed(),
            ])
            ->navigationItems([
                NavigationItem::make('Legal')
                    ->icon('heroicon-o-document-text')
                    ->url(function () {
                        return filament()->getPanel('legal')->route('pages.dashboard');
                    })
                    ->group('Servicepeople'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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
            ])
            ->plugins([
                FilamentApexChartsPlugin::make(),
                FilamentShieldPlugin::make(),
                BreezyCore::make()->myProfile(),
                ChangePasswordAction::make(),
            ]);

    }
}
