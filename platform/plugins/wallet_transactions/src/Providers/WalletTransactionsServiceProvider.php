<?php

namespace Botble\WalletTransactions\Providers;

use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Base\Facades\DashboardMenu;
use Botble\WalletTransactions\Models\WalletTransactions;

class WalletTransactionsServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        
        // ✅ Load routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        // ✅ Load views (this fixes "No hint path defined for [plugins/wallet_transactions]")
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'plugins/wallet_transactions');

        // ✅ Load translations (optional, if you have lang files)
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'plugins/wallet_transactions');

            
            DashboardMenu::default()->beforeRetrieving(function () {
                DashboardMenu::registerItem([
                    'id' => 'cms-plugins-wallet_transactions',
                    'priority' => 5,
                    'parent_id' => null,
                    'name' => 'plugins/wallet_transactions::wallet_transactions.name',
                    'icon' => 'ti ti-box',
                    'url' => route('wallet_transactions.index'),
                    'permissions' => ['wallet_transactions.index'],
                ]);
            });
    }
}
