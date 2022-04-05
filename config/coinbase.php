<?php

return [
    'apiKey' => env('COINBASE_API_KEY', 'e4a5bc71-3fd4-4626-ac5f-88cadb48e4a3'),
    'apiVersion' => env('COINBASE_API_VERSION', '2018-03-22'),

    'webhookSecret' => env('COINBASE_WEBHOOK_SECRET', 'a84578de-1363-4b00-aa83-55772f32ad74'),
    'webhookJobs' => [
         'charge:created' => \App\Jobs\CoinbaseWebhooks\HandleCreatedCharge::class,
         'charge:confirmed' => \App\Jobs\CoinbaseWebhooks\HandleConfirmedCharge::class,
        // 'charge:failed' => \App\Jobs\CoinbaseWebhooks\HandleFailedCharge::class,
        // 'charge:delayed' => \App\Jobs\CoinbaseWebhooks\HandleDelayedCharge::class,
        // 'charge:pending' => \App\Jobs\CoinbaseWebhooks\HandlePendingCharge::class,
        // 'charge:resolved' => \App\Jobs\CoinbaseWebhooks\HandleResolvedCharge::class,
    ],
    'webhookModel' => Shakurov\Coinbase\Models\CoinbaseWebhookCall::class,
];
