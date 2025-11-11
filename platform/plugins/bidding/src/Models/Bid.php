<?php

namespace Botble\Bidding\Models;

use Botble\Base\Models\BaseModel;
use Botble\ACL\Models\User;
use Botble\Ecommerce\Models\Customer;

class Bid extends BaseModel
{
    protected $table = 'bids';

    protected $fillable = [
        'bidding_system_id', 'customer_id', 'amount', 'status'
    ];
    

    public function biddingSystem()
    {
        return $this->belongsTo(BiddingSystem::class, 'bidding_system_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
