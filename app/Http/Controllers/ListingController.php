<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    // * 引入權限操作,詳見ListingPolicy
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    // * 除了 index, show 其他功能都需要通過登入驗證才能用，與web.php 的驗證功能擇一使用即可
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index' , 'show']);
    // }

    // * create, store, edit, update,delete 改到個人頁面，只有管理者或擁有者才能刪 ,參閱 realtorListingController.php

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
                    ->withoutSold() //列出尚未出售者
                    ->paginate(10)
                    ->withQueryString(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        // if (Auth::user()->cannot('view', $listing)) {
        //     abort(403);
        // }
        // $this->authorize('view', $listing);

        // 在show頁面顯示圖片
        $listing->load(['images']);

        // 取得出價紀錄
        $offer = !Auth::user() ? null : $listing->offers()->byMe()->first();

        return inertia(
            'Listing/Show', [
                'listing'   => $listing,
                'offerMade' => $offer,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Listing $listing)
    // {
    //     // * soft delete
    //     $listing->delete();

    //     // ! force delete
    //     // $listing->forceDelete();

    //     return redirect()->route('listing.index')
    //         ->with('success', 'Listing was deleted!');
    // }

}
