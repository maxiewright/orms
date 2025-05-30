<?php

namespace App\Providers\Filament;

use App\Actions\FilamentPasswordAction;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step as WizardStep;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Enums\MaxWidth;
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
use RalphJSmit\Filament\Onboard\FilamentOnboard;
use RalphJSmit\Filament\Onboard\Http\Livewire\Wizard;
use RalphJSmit\Filament\Onboard\Http\Middleware\OnboardMiddleware;
use RalphJSmit\Filament\Onboard\Step;
use RalphJSmit\Filament\Onboard\Track;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->default()
            ->path('admin')
            ->login()
            ->emailVerification()
            ->maxContentWidth(MaxWidth::Full)
            ->navigationGroups([
                NavigationGroup::make()->label('Servicepeople'),
                NavigationGroup::make()->label('Officers'),
                NavigationGroup::make()->label('Registry')->collapsed(),
                NavigationGroup::make()->label('Administration'),
                NavigationGroup::make()->label('Metadata')->collapsed(),
                NavigationGroup::make()->label('Access Control')->collapsed(),

            ])
            ->navigationItems([
                NavigationItem::make('Registry')
                    ->group('Registry')
                    ->icon('heroicon-o-archive-box')
                    ->url('/registry')
                    ->activeIcon('heroicon-s-archive-box')
                    ->sort(10),
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
                FilamentDeveloperLoginsPlugin::make()
                    ->enabled(! app()->isProduction())
                    ->users([
                        'Maxe Wright' => 'maxie.wright@ttdf.mil.tt',
                    ]),
                FilamentOnboard::make()
                    ->addTrack(fn () => Track::make([
                        Step::make(name: 'Change Password', identifier: 'widget::change-password')
                            ->description('Change your password before continuing to your workspace')
                            ->completeIf(fn () => auth()->user()->passwordChanged())
                            ->wizard([
                                WizardStep::make('Current Password')
                                    ->schema([
                                        TextInput::make('current_password')
                                            ->label(__('Current Password'))
                                            ->helperText(__('Enter the password provided to you'))
                                            ->password()
                                            ->currentPassword()
                                            ->required(),
                                    ]),
                                WizardStep::make('Change Password')->schema([
                                    TextInput::make('new_password')
                                        ->label(__('filament-breezy::default.fields.new_password'))
                                        ->helperText(__('The password must be at least 8 characters'))
                                        ->password()
                                        ->rules(filament('filament-breezy')->getPasswordUpdateRules())
                                        ->required(),
                                    TextInput::make('new_password_confirmation')
                                        ->label(__('filament-breezy::default.fields.new_password_confirmation'))
                                        ->password()
                                        ->same('new_password')
                                        ->required(),
                                ]),
                            ])->wizardSubmitFormUsing(function (array $state, Wizard $livewire): void {
                                (new FilamentPasswordAction)->update($state, $livewire);
                            }),
                    ])->completeBeforeAccess()),
            ]);

    }
}
