<?php

return [
    'plugin' => [
        'name' => 'wallet',
        'description' => '',
        'setting_store' => 'Setting wallet',
        'wallet' => 'Wallet',
        'wallets' => 'Wallets',
        'transactions' => 'Transactions',
    ],
    'model' => [
        'wallet' => [
            'id' => 'Id',
            'user' => 'User',
            'current_balance' => 'Current balance',
            'public_id' => 'Public id',
            'status' => 'Status',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ],
        'transaction' => [
            'id' => 'Id',
            'public_id' => 'Public id',
            'wallet' => 'Wallet',
            'amount' => 'Amount',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ],
    ],
    'controller' => [
        'wallets' => [
            'wallets' => 'Wallets',
        ],
        'transactions' => [
            'transactions' => 'Transactions',
        ],
    ],
];
