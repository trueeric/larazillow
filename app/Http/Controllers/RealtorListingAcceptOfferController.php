<?php

namespace App\Http\Controllers;

use App\Models\offer;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        // Accept selected offer
        $offer->update(['accepted_at' => now()]);

        // update sold_at time
        $offer->listing->sold_at = now();
        $offer->listing->save();

        // Reject all other offers
        $offer->listing->offers()->except($offer)
            ->update(['rejected_at' => now()]);

        return redirect()->back()
            ->with(
                'success',
                "Offer #{$offer->id} accepted, other offers rejected."
            );

    }
}