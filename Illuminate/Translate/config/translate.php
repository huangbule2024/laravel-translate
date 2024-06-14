<?php

return [
    'driver' => env('TRANSLATE_DRIVER', 'niu'),

    'niu' => [
        'api_key' => env('NIU_API_KEY', ''),
    ],

    'iflytek' => [
        'app_id' => env('IFLYTEK_APP_ID', ''),
        'app_key' => env('IFLYTEK_APP_KEY', ''),
        'app_secret' => env('IFLYTEK_APP_SECRET', ''),
    ]

];
