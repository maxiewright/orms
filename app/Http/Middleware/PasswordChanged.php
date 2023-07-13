<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PasswordChanged
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->passwordChanged()) {
            return $next($request);
        }

        return redirect()->route('profile.edit');
    }
}
