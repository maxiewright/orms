<?php

namespace App\Actions;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step as WizardStep;
use RalphJSmit\Filament\Onboard\FilamentOnboard;
use RalphJSmit\Filament\Onboard\Http\Livewire\Wizard;
use RalphJSmit\Filament\Onboard\Step;
use RalphJSmit\Filament\Onboard\Track;

class ChangePasswordAction
{
    public static function make(): FilamentOnboard
    {
        return FilamentOnboard::make()
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
                    ])->wizardSubmitFormUsing(function (array $state, Wizard $livewire) {
                        (new FilamentPasswordAction())->update($state, $livewire);
                    }),
            ])->completeBeforeAccess());
    }
}
