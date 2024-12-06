<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PasswordChanged
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->passwordChanged()) {
            return $next($request);
        }

        return redirect()->route('profile.edit');
    }
}
