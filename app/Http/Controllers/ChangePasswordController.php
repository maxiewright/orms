<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasswordChangeRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ChangePasswordController extends Controller
{


    public function create(): View
    {
        return view('auth.change-password');
    }

    public function store(StorePasswordChangeRequest $request): RedirectResponse
    {
        Auth::user()->update([
            'password' => Hash::make($request->get('password')),
            'password_changed_at' => now()
        ]);

        return redirect()->intended()->with('success', 'Password changed!');
    }

}