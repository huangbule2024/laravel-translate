<?php

return [
    'driver' => env('TRANSLATE_DRIVER', 'niu'),

    'niu' => [
        'api_key' => env('NIU_API_KEY', '1989ea8c47368fbc6aad114e0c30c289'),
    ],

    'iflytek' => [
        'app_id' => env('IFLYTEK_APP_ID', ''),
        'app_key' => env('IFLYTEK_APP_KEY', ''),
        'app_secret' => env('IFLYTEK_APP_SECRET', ''),
    ]

];
