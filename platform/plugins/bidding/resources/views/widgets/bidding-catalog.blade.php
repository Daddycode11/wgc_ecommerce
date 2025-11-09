<?php

namespace Botble\Bidding\Widgets;

use Botble\Widget\AbstractWidget;
use Botble\Bidding\Models\BiddingSystem;

class BiddingCatalog extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Bidding Catalog'),
            'description' => __('Displays live bidding items with countdown.'),
        ]);
    }

    public function run(): ?string
    {
        $bids = BiddingSystem::with('highestBid', 'product')
            ->where('is_published', 1)
            ->where('end_time', '>=', now())
            ->get();

        return view('plugins/bidding::catalog.bidding-frontend', compact('bids'));
    }
}
