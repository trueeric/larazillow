<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function create()
    {
        return inertia('Auth/Login');
    }
    public function store(Request $request)
    {
        // $request->validate([
        //     'email'    => 'required|string|email',
        //     'password' => 'required|string',
        // ]);

        if (!Auth::attempt($request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]), true)) {
            throw ValidationException::withMessages([
                'email' => 'Authentication failed!',
            ]);
        }

        $request->session()->regenerate();
        // laravel 的語法 return redirect()->intended()
        return redirect()->intended('/listing');
    }
    public function destroy(Request $request)
    {
        Auth::logout();

        // * session失效，csrf token重算
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('listing.index');
    }

}
