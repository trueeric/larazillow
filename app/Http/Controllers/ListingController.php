<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    // * 除了 index, show 其他功能都需要通過登入驗證才能用，與web.php 的驗證功能擇一使用即可
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index' , 'show']);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']);

        //  not use when
        // if ($filters['priceFrom'] ?? false) {
        //     $query->where('price', '>=', $filters['priceFrom']);
        // }

        // scopeActive
        // $query->where()->active;

        return inertia(
            'Listing/Index',
            [
                'filters'  => $filters,
                'listings' => Listing::mostRecent()
                    ->filter($filters)
                    ->paginate(10)
                    ->withQueryString(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Listing::class);

        return inertia('Listing/Create');
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

        return redirect()->route('listing.index')
            ->with('success', 'Listing was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        // if (Auth::user()->cannot('view', $listing)) {
        //     abort(403);
        // }
        // $this->authorize('view', $listing);

        return inertia(
            'Listing/Show', [
                'listing' => $listing,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Listing/Edit', [
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

        return redirect()->route('listing.index')
            ->with('success', 'Listing was changed!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->route('listing.index')
            ->with('success', 'Listing was deleted!');
    }
}
