<?php

return [
    [
        'name' => 'Raffles',
        'flag' => 'raffle.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'raffle.create',
        'parent_flag' => 'raffle.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'raffle.edit',
        'parent_flag' => 'raffle.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'raffle.destroy',
        'parent_flag' => 'raffle.index',
    ],
];
