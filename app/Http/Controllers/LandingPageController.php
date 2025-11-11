<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\RaffleEntries;
use App\Models\Wallet;
use Botble\Bidding\Models\BiddingSystem;
use Botble\Raffle\Models\Raffle;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function Bid(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'bidding_system_id' => 'required|exists:bidding_systems,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $biddingSystemId = $request->input('bidding_system_id');
        $amount = $request->input('amount');

        $userWallet = Wallet::where("customer_id", $request->customer_id)->first();
        if ($userWallet->balance < $amount) {
            return response()->json(['error' => 'Insufficient balance in wallet.'], 400);
        }
        $userWallet->balance -= $amount;

        
        $biddingSystem = BiddingSystem::where("id", $biddingSystemId)->first();
        $userWallet->save();
        // dd($biddingSystem->highestBid()->first());
        $lastBid = Wallet::where("customer_id", $biddingSystem->highestBid()->first()->customer_id)->first();
        $lastBid->balance += $biddingSystem->highestBid()->first()->amount;
        // dd($lastBid);
        $lastBid->save();
        $dd = Bid::create([
            'bidding_system_id' => $biddingSystemId,
            'customer_id' => $request->customer_id,
            'amount' => $amount,
            'status' => 'published',
        ]);
        return response()->json(['message' => 'Bid placed successfully.', "balance" => $userWallet->balance], 200);
    }

    public function UpdateBidWinner(Request $request)
    {

        $biddings = BiddingSystem::where('end_time', '<=', now())
            ->whereNull('winner_id')
            ->get();

        foreach ($biddings as $bidding) {
            $highestBid = $bidding->highestBid()->first();

            if ($highestBid) {
                $bidding->update([
                    'winner_id' => $highestBid->customer_id
                ]);

                // Optional: Send email/notification to the winner here
            } else {
                return response()->json(['message' => "Auction '{$bidding->title}' ended with no bids."], 200);
            }
        }
        return response()->json(['message' => 'Bid winner updated successfully.'], 200);
    }

    public function JoinRaffle(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'raffle_promo_id' => 'required|exists:raffles,id',
            'customer_id' => 'required|exists:ec_customers,id',
            'slots' => 'required|integer|min:1',
        ]);
        $wallet = Wallet::where("customer_id", $request->customer_id)->first();
        $raffle = Raffle::where('id', $request->input('raffle_promo_id'))->first();
        if (!$raffle) {
            return response()->json(['error' => 'Raffle not found.'], 404);
        }
        $totalCost = $raffle->ticket_price * $request->input('slots');
        if ($wallet->balance < $totalCost) {
            return response()->json(
                ['error' => 'Insufficient balance in wallet.'],
                400
            );
        }
        $wallet->balance -= $totalCost;
        $wallet->save();
        if ($raffle->number_of_tickets < $request->input('slots')) {
            return response()->json(['error' => 'Not enough tickets available in the raffle.'], 400);
        }
        for ($i = 0; $i < $request->input('slots'); $i++) {
            RaffleEntries::create([
                'raffle_promo_id' => $request->input('raffle_promo_id'),
                'customer_id' => $request->input('customer_id'),
                'entry_code' => uniqid('raffle_'),
            ]);
        }
        $raffle->number_of_tickets -= $request->input('slots');
        $raffle->save();



        // Logic to join the raffle
        // For example, create a RaffleEntry record linking the user to the raffle

        return response()->json(['message' => 'Successfully joined the raffle.', 'balance' => $wallet->balance, 'slots' => $request->input('slots')], 200);
    }

    public function getRaffleEntries(Request $request)
    {
        $entries = RaffleEntries::where("raffle_promo_id", $request->raffle_promo_id)->get();

        return response()->json([
            "data" => $entries
        ],200);
    }

    public function updateWinner(Request $request)
    {
        $assignwinner = Raffle::where("id", $request->raffle_id)->first();
        if(!$assignwinner){
            return response()->json(['error' => 'Raffle not found.'], 404);
        }
        if($assignwinner->winner_code){
            return response()->json(['error' => 'Winner already assigned.'], 400);
        }
        $assignwinner->winner_code = $request->winner_code;
        $assignwinner->save();
        return response()->json(['message' => 'Winner updated successfully.'], 200);
    }
}
