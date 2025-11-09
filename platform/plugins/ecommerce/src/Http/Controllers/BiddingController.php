<?php

namespace Theme\Ecommerce\Http\Controllers;

use Botble\Bidding\Models\BiddingSystem;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Botble\Bidding\Models\BiddingOffer; // if you have a bids table

class BiddingController extends BaseController
{
    public function index()
    {
        $biddingItems = BiddingSystem::with('product')
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        return Theme::scope('bidding.index', compact('biddingItems'))->render();
    }

    public function show($slug)
    {
        $biddingItem = BiddingSystem::with('product')
            ->whereHas('product', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })
            ->firstOrFail();

        return Theme::scope('bidding.show', compact('biddingItem'))->render();
    }

    public function placeBid(Request $request, $id)
    {
        $request->validate([
            'bid_amount' => 'required|numeric|min:1',
        ]);

        $bidding = BiddingSystem::findOrFail($id);

        // Assuming you have a BiddingOffer model
        BiddingOffer::create([
            'bidding_system_id' => $bidding->id,
            'user_id' => auth('customer')->id(),
            'amount' => $request->bid_amount,
        ]);

        return redirect()->back()->with('success', 'Your bid has been placed successfully!');
    }
}
