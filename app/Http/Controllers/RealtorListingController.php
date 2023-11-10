<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{
    // * 引入權限操作,詳見ListingPolicy
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }
    public function index()
    {

        return inertia('Realtor/Index',
            ['listings' => Auth::user()->listings]
        );
    }

    public function destroy(Listing $listing)
    {
        // * soft delete
        $listing->deleteOrFail();

        // ! force delete
        // $listing->forceDelete();

        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }
}
