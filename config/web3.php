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
      'nft' => env('NFT_ADDRESS', '0x968bfda2b4d206dc6b83011c9ebcc017169a6fd5'),
      'token' => env('TOKEN_ADDRESS', '0xc6fDe3FD2Cc2b173aEC24cc3f267cb3Cd78a26B7') // Yeenus test token
    ],

    'wallet' => [
      'seed' => env('WALLET_SEED', 'clerk census armor insane girl bargain secret ticket author nurse pony female'),
      'address' => env('WALLET_ADDRESS', '0x1978a92b590EcbC678613a38FDa020A139Fb6592')
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
