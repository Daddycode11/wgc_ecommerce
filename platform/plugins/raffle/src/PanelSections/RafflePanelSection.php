<?php

namespace Botble\Raffle\PanelSections;

use Botble\Base\PanelSections\PanelSection;

class RafflePanelSection extends PanelSection
{
    public function setup(): void
    {
        $this
            ->setId('settings.{id}')
            ->setTitle('{title}')
            ->withItems([
                //
            ]);
    }
}
