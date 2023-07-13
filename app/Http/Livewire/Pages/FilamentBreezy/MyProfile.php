<?php

namespace App\Http\Livewire\Pages\FilamentBreezy;

use JeffGreco13\FilamentBreezy\Pages\MyProfile as BaseProfile;
use Livewire\Component;

class MyProfile extends BaseProfile
{
    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.pages.filament-breezy.my-profile');
    }
}
