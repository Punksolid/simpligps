<?php

return [
    'base_url' => env('TRACCAR_BASE_URL'),

    'debug_requests' => env('TRACCAR_DEBUG_REQUEST', env('TELESCOPE_ENABLED', false)),

    'auth' => [
        'username' => env('TRACCAR_USERNAME'),
        'password' => env('TRACCAR_PASSWORD'),
    ]
];