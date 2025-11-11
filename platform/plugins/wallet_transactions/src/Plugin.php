<?php

namespace Botble\WalletTransactions;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('Wallet_Transactions');
        Schema::dropIfExists('Wallet_Transactions_translations');
    }
}
