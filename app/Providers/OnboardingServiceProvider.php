<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use JeffGreco13\FilamentBreezy\FilamentBreezy;
use RalphJSmit\Filament\Onboard\Facades\Onboard;
use RalphJSmit\Filament\Onboard\Http\Livewire\Wizard;

class OnboardingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Filament::serving(function () {
            Onboard::make()
                ->addTrack([
                    Onboard::addStep(name: 'Change Password', identifier: 'widget::change-password')
                        ->description('Change your password before continuing to your workspace')
                        ->completeIf(fn() => auth()->user()->passwordChanged())
                        ->wizard([
                            Step::make("Current Password")->schema([
                                TextInput::make("current_password")
                                    ->label(__('Current Password'))
                                    ->helperText(__("Enter the password provided to you"))
                                    ->password()
                                    ->currentPassword()
                                    ->required(),
                            ]),
                            Step::make("Change Password")->schema([
                                TextInput::make("new_password")
                                    ->label(__('filament-breezy::default.fields.new_password'))
                                    ->helperText(__("The password must be at least 8 characters"))
                                    ->password()
                                    ->rules(app(FilamentBreezy::class)
                                        ->getPasswordRules())
                                    ->required(),
                                TextInput::make("new_password_confirmation")
                                    ->label(__('filament-breezy::default.fields.new_password_confirmation'))
                                    ->password()
                                    ->same("new_password")
                                    ->required(),
                            ])

                        ])
                        ->wizardSubmitFormUsing(function (array $state, Wizard $livewire) {
                            $this->updatePassword($state, $livewire);
                        })

                ])
                ->completeBeforeAccess();
        });
    }


    /**
     * @param array $state
     * @param Wizard $livewire
     * @return void
     */
    private function updatePassword(array $state, Wizard $livewire): void
    {
        $user = tap(Filament::auth()->user(), function ($user) use ($state) {
            $user->password = Hash::make($state['new_password']);
            $user->password_changed_at = now();
            $user->save();
        });

        session()->forget('password_hash_' . config('filament.auth.guard'));

        Filament::auth()->login($user);

        $livewire->redirect(route('filament.pages.dashboard'));
    }
}

