<?php

return [

    /*
    |--------------------------------------------------------------------------
    | NFT Address
    |--------------------------------------------------------------------------
    | 
    | Address of NFT that is used for user login
    |
    */

    'chain' => [
      'network' => env('NETWORK', 'Rinkeby'),
      'rpc' => env('RPC_URL', 'https://eth-rinkeby.alchemyapi.io/v2/bVdkpTETSD4e0kKvvUX4Yqwtr787tkgN'),
      'nft' => env('NFT_ADDRESS', '0xf5f9d0d0c28446c49e4be464edb76a0509336076'),
      'token' => env('TOKEN_ADDRESS', '0xc6fDe3FD2Cc2b173aEC24cc3f267cb3Cd78a26B7') // Yeenus test token
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Information
    |--------------------------------------------------------------------------
    |
    */

    'model' => [
        'table' => 'users',
        'column' => 'wallet_address',
    ]
];
