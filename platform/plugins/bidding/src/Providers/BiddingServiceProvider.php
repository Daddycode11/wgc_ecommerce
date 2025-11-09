<?php

namespace Botble\Bidding\Providers;

use Illuminate\Support\ServiceProvider;
use Botble\Base\Facades\DashboardMenu;

class BiddingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // ✅ Load routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        // ✅ Load views (this fixes "No hint path defined for [plugins/bidding]")
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'plugins/bidding');

        // ✅ Load translations (optional, if you have lang files)
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'plugins/bidding');

        // ✅ Register admin sidebar menu
        DashboardMenu::default()->beforeRetrieving(function () {
            DashboardMenu::registerItem([
                'id' => 'cms-plugins-bidding-system',
                'priority' => 5,
                'parent_id' => null,
                'name' => 'Bidding System',
                'icon' => 'fa fa-gavel',
                'url' => route('bidding-system.index'),
                'permissions' => ['bidding-system.index'],
            ]);
        });
    }
}
