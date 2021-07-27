<?php
/*
return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'token',
            'provider' => 'users',
        ],

        // 'web' => [
        //     'driver' => 'session',
        //     'provider' => 'users',
        // ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
    ],

    'providers' => [
        // 'users' => [
        //     'driver' => 'eloquent',
        //     'model' => App\Models\User::class,
        // ],

        'users' => [
            'driver' => 'database',
            'table' => 'user',
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
*/

/*
return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'customer'),
    ],

    'guards' => [
        'customer' => [
            'driver' => 'token',
            'provider' => 'customers',
        ],
        'admin' => [
            'driver' => 'token',
            'provider' => 'admins',
        ]
    ],

    'providers' => [
        'customers' => [
            'driver' => 'eloquent',
            'model' => \App\Models\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => \App\Models\User::class,
        ]
    ],

    'passwords' => [
        //
    ],

];
*/