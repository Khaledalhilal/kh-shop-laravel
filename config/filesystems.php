<?php

return [



    'default' => env('FILESYSTEM_DISK', 'local'),



    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
        ],
        'back-img-category' => [
            'driver' => 'local',
            'root' => public_path(''),
            'url' => env('APP_URL'),
            'visibility' => 'public',
        ],
        'profile-image' => [
            'driver' => 'local',
            'root' => public_path(''),
            'url' => env('APP_URL'),
            'visibility' => 'public',
        ],
        'back-img-subCategory' => [
            'driver' => 'local',
            'root' => public_path(''),
            'url' => env('APP_URL'),
            'visibility' => 'public',
        ],
        'back-img-product' => [
            'driver' => 'local',
            'root' => public_path(''),
            'url' => env('APP_URL'),
            'visibility' => 'public',
        ],
        'back-img-landing' => [
            'driver' => 'local', // Specify the local driver
            'root' => public_path(''), // Specify the root directory
            'url' => env('APP_URL'), // Specify the URL
            'visibility' => 'public',
        ],



        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],


    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
