<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        // return "index ";
        return inertia('Index/Index');
    }
    public function show()
    {
        // return "show hello ";
        return inertia('Index/Show');

    }
}
