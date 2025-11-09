<?php

namespace Botble\Bidding\Models;

use Botble\Base\Models\BaseModel;
use Botble\Ecommerce\Models\Product;
use Botble\ACL\Models\User;

class BiddingSystem extends BaseModel
{
    protected $table = 'bidding_systems';

    protected $fillable = [
        'title', 'product_id', 'starting_price', 'min_bid_increment',
        'image', 'is_published', 'end_time', 'winner_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'bidding_system_id');
    }

    // Relationship to get highest bid for eager loading
    public function highestBid()
    {
        return $this->hasOne(Bid::class, 'bidding_system_id')
                    ->where('status', 'published')
                    ->orderByDesc('amount');
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }
}
