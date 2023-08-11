<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function create()
    {
        return inertia('UserAccount/Create');
    }
    public function store(Request $request)
    {
        $user = User::create($request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',

        ]));
        // * laravel 10 User:create() password可直接生成Hash，以下動作僅供參考
        // * 這裡不做Hash，改到 User.php去做 password Hash
        // $user->password = Hash::make($user->password);

        // $user->save();
        Auth::login($user);

        return redirect()->route('listing.index')
            ->with('success', 'Account created!');
    }
}
