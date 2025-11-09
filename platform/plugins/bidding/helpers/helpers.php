<?php

use Botble\Bidding\Models\BiddingSystem;
use Botble\Shortcode\Facades\Shortcode;

Shortcode::register('bidding-system', 'Bidding System', 'Displays active bidding items', function ($shortcode) {
    $bids = BiddingSystem::with('product')
        ->where('status', 'published')
        ->where('end_time', '>', now())
        ->orderBy('created_at', 'desc')
        ->take(8)
        ->get();

    return Theme::partial('bidding-system', compact('bids'));
});
