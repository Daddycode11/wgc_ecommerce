<?php

namespace Botble\Bidding\Models;

use Botble\Base\Models\BaseModel;
use Botble\ACL\Models\User;

class Bid extends BaseModel
{
    protected $table = 'bids';

    protected $fillable = [
        'bidding_system_id', 'user_id', 'amount', 'status'
    ];

    public function biddingSystem()
    {
        return $this->belongsTo(BiddingSystem::class, 'bidding_system_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
