<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        $listing->load(['images']);
        return inertia(
            'Realtor/ListingImage/Create',
            ['listing' => $listing]
        );
    }
    public function store(Listing $listing, Request $request)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // 存在public/images/ 下
                $path = $file->store('images', 'public');

                $listing->images()->save(new ListingImage([
                    'filename' => $path,
                ]));

            }
        }
        return redirect()->back()->with('success', 'Images uploaded');
    }

    public function destroy(Listing $listing, ListingImage $image)
    {
        // *刪實體檔
        Storage::disk('public')->delete($image->filename);
        // *刪資料庫紀錄
        $image->delete();

        return redirect()->back()->with("success", "Image was deleted!");

    }
}
