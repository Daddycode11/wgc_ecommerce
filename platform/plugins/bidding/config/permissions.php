<?php

return [
    [
        'name' => 'Bidding systems',
        'flag' => 'bidding-system.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'bidding-system.create',
        'parent_flag' => 'bidding-system.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'bidding-system.edit',
        'parent_flag' => 'bidding-system.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'bidding-system.destroy',
        'parent_flag' => 'bidding-system.index',
    ],
];
