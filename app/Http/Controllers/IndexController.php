<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        // Listing::create(['beds'=>2,'baths'=>2,'area'=>120,'city'=>80,'country'=>'south','street'=>'Nanyuan st','street_nr'=>33,'code'=>'TS','price'=>220_100])
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
