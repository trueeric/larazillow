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
                    ->filter($filters)
                    ->withCount('images')
                    ->withCount('offers')
                    ->paginate(5)
                    ->withQueryString(),
            ]
        );
    }

    public function show(Listing $listing)
    {

        return inertia('Realtor/Show',
            [
                'listing' =>
                // 顯出出價紀錄及出價者(要到Offer.php,Offer.vue做相對調整)
                $listing->load('offers', 'offers.bidder'),
            ]
        );
    }

    public function create()
    {
        // $this->authorize('create', Listing::class);
        return inertia('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // 原始方式
        // Listing::created($request->all());
        // 針對所有fillable的欄位，一次全部新增，但是沒法一一驗證各欄位的有效性
        // Listing::create(
        // 增加listing 的owner user
        $request->user()->listings()->create(
            $request->validate([
                'beds'      => 'required|integer|min:0|max:20',
                'baths'     => 'required|integer|min:0|max:20',
                'area'      => 'required|integer|min:15|max:1500',
                'city'      => 'required',
                'code'      => 'required',
                'street'    => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price'     => 'required|integer|min:1|max:20000000',

            ]),
        );

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing was created!');
    }
    public function edit(Listing $listing)
    {
        return inertia(
            'Realtor/Edit', [
                'listing' => $listing,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                'beds'      => 'required|integer|min:0|max:20',
                'baths'     => 'required|integer|min:0|max:20',
                'area'      => 'required|integer|min:15|max:1500',
                'city'      => 'required',
                'code'      => 'required',
                'street'    => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price'     => 'required|integer|min:1|max:20000000',

            ]),
        );

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing was changed!');
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
    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()
            ->with('success', 'Listing was restored!');
    }
}
