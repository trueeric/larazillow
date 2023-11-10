<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{
    public function index()
    {

        return inertia('Realtor/Index',
            ['listings' => Auth::user()->listings]
        );
    }
}
