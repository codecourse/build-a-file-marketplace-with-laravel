<?php

return [
    'secret' => env('STRIPE_SECRET'),

    'webhook' => [
        'secret' => env('STRIPE_WEBHOOK_SECRET')
    ]
];
