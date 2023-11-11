<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{
    // * 引入權限操作,詳見ListingPolicy
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }
    public function index(Request $request)
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order']),
        ];
        return inertia('Realtor/Index',
            // * withTrashed() v.s. onlyTrashed()
            // * withTrashed()列出所有，包含被soft deleted的資料
            // * onlyTrashed() 僅列出被soft deleted的資料
            [
                'filters' => $filters, //讀入網址的參數
                'listings' => Auth::user()
                    ->listings()
                // ->mostRecent()
                    ->filter($filters)
                    ->get(),
            ]
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
