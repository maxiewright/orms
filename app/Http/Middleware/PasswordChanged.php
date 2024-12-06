<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Closure;
use Illuminate\Http\Request;

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
