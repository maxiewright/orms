<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LoginResponse as FilamentLoginResponseContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class FilamentLoginResponse implements FilamentLoginResponseContract
{
    public function toResponse($request)
    {
        if (filament()->getPanel('servicepeople')) {
            return redirect()->route('filament.servicepeople.home');
        }

        if (filament()->getPanel('legal')) {
            return redirect()->route('filament.legal.pages.dashboard');
        }


    }
}
