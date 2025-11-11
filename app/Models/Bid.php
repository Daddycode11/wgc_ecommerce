<?php

namespace App\Models;

use Botble\Bidding\Models\BiddingSystem;
use Botble\Ecommerce\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    protected $table = 'bids';
    protected $fillable = ['bidding_system_id','amount', 'status', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function biddingSystem()
    {
        return $this->belongsTo(BiddingSystem::class);
    }
}
