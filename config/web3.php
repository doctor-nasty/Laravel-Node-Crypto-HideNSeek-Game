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
      'nft' => env('NFT_ADDRESS', '0x42d4a210343d5a75bc07f34de063ff57fa5b2064'),
      'token' => env('TOKEN_ADDRESS', '0x3b00ef435fa4fcff5c209a37d1f3dcff37c705ad')
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
