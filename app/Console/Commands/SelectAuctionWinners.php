<?php

namespace App\Console\Commands;

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
    protected $description = 'Select the highest bidder as the winner for auctions that ended';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // Get all ended auctions without a winner
        $biddings = BiddingSystem::where('end_time', '<=', now())
            ->whereNull('winner_id')
            ->get();

        foreach ($biddings as $bidding) {
            $highestBid = $bidding->highestBid();

            if ($highestBid) {
                $bidding->update([
                    'winner_id' => $highestBid->user_id
                ]);

                $this->info("Auction '{$bidding->title}' winner selected: User ID {$highestBid->user_id}");
                // Optional: Send email/notification to the winner here
            } else {
                $this->info("Auction '{$bidding->title}' ended with no bids.");
            }
        }

        return 0;
    }
}
