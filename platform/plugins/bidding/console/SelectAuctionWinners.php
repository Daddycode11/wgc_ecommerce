<?php

namespace Botble\Bidding\Console;

use Illuminate\Console\Command;
use Botble\Bidding\Models\BiddingSystem;

class SelectAuctionWinners extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'bidding:select-winners';

    /**
     * The console command description.
     */
    protected $description = 'Select winners for ended bidding systems automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for ended auctions...');

        // Fetch all auctions that have ended and no winner yet
        $endedAuctions = BiddingSystem::with('bids')
            ->whereNotNull('end_time')             // Make sure end_time exists
            ->where('end_time', '<=', now())       // Only ended auctions
            ->whereNull('winner_id')               // Only without winner
            ->get();

        if ($endedAuctions->isEmpty()) {
            $this->info('No auctions ended yet.');
            return;
        }

        foreach ($endedAuctions as $auction) {

            // Get highest bid for this auction
            $highestBid = $auction->bids()
                ->where('status', 'published')     // Only published bids
                ->orderByDesc('amount')
                ->first();

            if ($highestBid) {
                $auction->winner_id = $highestBid->user_id;
                $auction->save();

                $this->info("Winner selected for auction '{$auction->title}' (ID: {$auction->id}): User ID {$highestBid->user_id}, Bid Amount ₱" . number_format($highestBid->amount, 2));
            } else {
                $this->info("No bids for auction '{$auction->title}' (ID: {$auction->id})");
            }
        }

        $this->info('✅ Auto winner selection completed!');
    }
}
