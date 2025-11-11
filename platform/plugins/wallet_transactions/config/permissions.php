<?php

return [
    [
        'name' => 'Wallet  transactions',
        'flag' => 'wallet_transactions.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'wallet_transactions.create',
        'parent_flag' => 'wallet_transactions.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'wallet_transactions.edit',
        'parent_flag' => 'wallet_transactions.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'wallet_transactions.destroy',
        'parent_flag' => 'wallet_transactions.index',
    ],
];
