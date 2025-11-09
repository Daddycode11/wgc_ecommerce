<?php

use Botble\Widget\AbstractWidget;
use Illuminate\Support\Collection;

class EventWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Event'),
            'description' => __('Widget description'),
        ]);
    }

    protected function data(): array|Collection
    {
        return [];
    }
}
