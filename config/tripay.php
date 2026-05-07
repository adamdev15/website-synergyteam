<?php

return [
    'api_key'       => env('TRIPAY_API_KEY'),
    'private_key'   => env('TRIPAY_PRIVATE_KEY'),
    'merchant_code' => env('TRIPAY_MERCHANT_CODE'),
    'callback_secret' => env('TRIPAY_CALLBACK_SECRET'),
    'mode'          => env('TRIPAY_MODE', 'sandbox'),
];
