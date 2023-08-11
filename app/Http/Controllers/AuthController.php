<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function create()
    {
        return inertia('Auth/Login');
    }
    public function store()
    {
        //
    }
    public function destroy()
    {
        //
    }

}
