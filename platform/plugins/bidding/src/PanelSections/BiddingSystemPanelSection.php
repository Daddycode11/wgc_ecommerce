<?php

namespace Botble\Bidding\PanelSections;

use Botble\Base\PanelSections\PanelSection;

class BiddingSystemPanelSection extends PanelSection
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
