<?php

namespace Botble\Raffle\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Raffle\Models\Raffle;
use Botble\Raffle\Http\Middleware\RafflePermissionMiddleware;

class RaffleServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/raffle')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions'])
            ->loadAndPublishTranslations()
            ->loadRoutes(['web']) // ensure routes/web.php loads
            ->loadAndPublishViews()
            ->loadMigrations();

        // ✅ Register for multi-language support (if enabled)
        if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
            \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Raffle::class, [
                'event_name',
                'prize_description',
            ]);
        }

        // ✅ Register in Dashboard Menu
        DashboardMenu::default()->beforeRetrieving(function () {
            DashboardMenu::registerItem([
                'id'          => 'cms-plugins-raffle',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => trans('plugins/raffle::raffle.name'),
                'icon'        => 'fa fa-ticket',
                'url'         => route('raffle.index'),
                'permissions' => ['raffle.index'],
            ]);
        });
    }
}
