<?php

namespace App\Actions;

use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Pages\Dashboard;
use Illuminate\Support\Facades\Hash;
use RalphJSmit\Filament\Onboard\Http\Livewire\Wizard;

class FilamentPasswordAction
{
    public function update(array $state, Wizard $livewire): void
    {
        $user = tap(Filament::auth()->user(), function ($user) use ($state) {
            $user->password = Hash::make($state['new_password']);
            $user->password_changed_at = now();
            $user->save();
        });

        session()->forget('password_hash_'.Filament::getCurrentPanel()->getAuthGuard());

        Filament::auth()->login($user);

        $livewire->redirect(Dashboard::getUrl());

        Notification::make()
            ->success()
            ->title('Password Changed!')
            ->send();
    }
}
