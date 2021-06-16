<?php

return [
    'checkout' => [
        'key' => [
            'public' => env('PAYMAYA_CHECKOUT_PUBLIC_KEY'),
            'secret' => env('PAYMAYA_CHECKOUT_SECRET_KEY'),
        ],
        'output_url' => [
            'production' => env('PAYMAYA_PRODUCTION_CHECKOUT_URL'),
            'sandbox' => env('PAYMAYA_SANDBOX_CHECKOUT_URL'),
        ]
    ],
    'payments' => [
        'key' => [
            'public' => env('PAYMAYA_PAYMENT_PUBLIC_KEY'),
            'secret' => env('PAYMAYA_PAYMENT_SECRET_KEY'),
        ],
    ],
    'environment' => env('PAYMAYA_ENVIRONMENT'),
    'logo_url' => env('PAYMAYA_LOGO_URL'),
    'icon_url' => env('PAYMAYA_ICON_URL'),
    'apple_touch_icon_url' => env('PAYMAYA_APPLE_TOUCH_ICON_URL'),
    'custom_title' => env('PAYMAYA_CUSTOM_TITLE'),
    'color_scheme' => env('PAYMAYA_COLOR_SCHEME'),
];
