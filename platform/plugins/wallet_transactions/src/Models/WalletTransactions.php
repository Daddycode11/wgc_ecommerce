<?php

namespace Botble\WalletTransactions\Models;

use App\Models\Wallet;
use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class WalletTransactions extends BaseModel
{
    protected $table = 'wallet_transactions';

   
     protected $fillable = ['wallet_id', 'amount', 'description', 'reference', 'status'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
