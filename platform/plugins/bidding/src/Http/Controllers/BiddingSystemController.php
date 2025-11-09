<?php

namespace Botble\Bidding\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Botble\Bidding\Models\BiddingSystem;
use Botble\Bidding\Models\Bid;
use Botble\Ecommerce\Models\Product;
use Botble\Base\Facades\BaseHelper;
use Illuminate\Support\Facades\Auth;

class BiddingSystemController extends BaseController
{
    public function index()
    {
        $biddingSystems = BiddingSystem::with('product', 'highestBid')->orderByDesc('created_at')->get();
        return view('plugins/bidding::index', compact('biddingSystems'));
    }

    public function create()
    {
        $products = Product::all();
        return view('plugins/bidding::create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'=>'required|string|max:255',
            'product_id'=>'required|exists:ec_products,id',
            'starting_price'=>'required|numeric|min:0',
            'min_bid_increment'=>'required|numeric|min:0',
            'end_time'=>'required|date|after:now',
            'image'=>'nullable|image|max:2048'
        ]);

        if($request->hasFile('image')){
            $validated['image'] = $request->file('image')->store('bidding', 'public');
        }

        BiddingSystem::create(array_merge($validated, [
            'is_published'=>$request->boolean('is_published')
        ]));

        return redirect()->route('bidding-system.index')
            ->with('success', BaseHelper::clean('✅ Bidding system created successfully.'));
    }

    public function edit(BiddingSystem $bidding_system)
    {
        $products = Product::all();
        return view('plugins/bidding::edit', compact('bidding_system','products'));
    }

    public function update(Request $request, BiddingSystem $bidding_system)
    {
        $validated = $request->validate([
            'title'=>'required|string|max:255',
            'product_id'=>'required|exists:ec_products,id',
            'starting_price'=>'required|numeric|min:0',
            'min_bid_increment'=>'required|numeric|min:0',
            'end_time'=>'required|date|after:now',
            'image'=>'nullable|image|max:2048'
        ]);

        if($request->hasFile('image')){
            $validated['image'] = $request->file('image')->store('bidding', 'public');
        }

        $bidding_system->update(array_merge($validated, [
            'is_published'=>$request->boolean('is_published')
        ]));

        return redirect()->route('bidding-system.index')
            ->with('success', BaseHelper::clean('✅ Bidding system updated successfully.'));
    }

    public function destroy(BiddingSystem $bidding_system)
    {
        $bidding_system->delete();
        return redirect()->route('bidding-system.index')
            ->with('success', BaseHelper::clean('🗑️ Bidding system deleted successfully.'));
    }
}
