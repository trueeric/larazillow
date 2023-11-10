<?php

namespace App\Http\Controllers;

class RealtorListingController extends Controller
{
    public function index()
    {
        return inertia('Realtor/Index');
    }
}
