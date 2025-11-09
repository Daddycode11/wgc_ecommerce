<?php

namespace Botble\Bidding;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('Bidding Systems');
        Schema::dropIfExists('Bidding Systems_translations');
    }
}
