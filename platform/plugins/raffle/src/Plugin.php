<?php

namespace Botble\Raffle;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('Raffles');
        Schema::dropIfExists('Raffles_translations');
    }
}
