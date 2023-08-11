<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        // dd(Listing::all());
        // return "index ";
        // dd(Auth::user());
        // dd(Auth::check());

        return inertia(
            'Index/Index', [
                'message' => 'Hello from Laravel!',
            ]
        );
    }
    public function show()
    {
        // return "show hello ";
        return inertia('Index/Show');

    }
}
