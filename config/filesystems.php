<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of clouddefault_icon
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),
    'level_default_icon' => 'default.png',
    'default_icon' => 'https://cdn.tharee.net/public/default.png',
    'default_level_quiz_image' => 'https://cdn.tharee.net/public/xjPyTnXb92klFk0F20375DAV7QmtJF2sm0xiorST.png',
    'default_level_mission_image' => 'https://cdn.tharee.net/public/gfYbzmRdCDvhhtKouHJG3V6mqJkYV9dsfwt2hcms.png',
    'lesson_watched' => 'https://cdn.tharee.net/public/tXrVq2xsJ5nPhoHa9CazyEDvtqV5DjS5kJ8zPpZu.png',
    'lesson_locked' => 'https://cdn.tharee.net/public/CGPfGOYUz3qb122vnyiDKXxeB0yFAAI82PBdbUgY.png',
    'lesson_pending' => 'https://cdn.tharee.net/public/zxsqiXeYpyevulx8Tk053bjHjPL0DawuHMdXOoVd.png',
    'quiz_locked' => 'https://cdn.tharee.net/public/hSokj5FlTP62fiqfSR1oIt9WEPaVTBv9vFHqyN9n.png',
    'mission_locked' => 'https://cdn.tharee.net/public/sEHU9QHiZ42OJlGK4M1BRD6a6awfQEToEED7SPOl.png',
    'quiz_open' => 'https://cdn.tharee.net/public/otBy2KaqPM1ACXg5XJCCUdpXRsquKThQO6G7jhma.png',
    'mission_open' => 'https://cdn.tharee.net/public/vwHjFo7tAV32ILZ6QD3QmtiCZ3cCEkGBTWqSlhKo.png',
    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
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

        'avatars' => [
            'driver' => 'sftp',
            'host' => 'cdn.tharee.net',
            'username' => 'dawul',
            'privateKey' => env('THAREE_CDN_PRIVATE_KEY'),
            'port' => 22,
            'timeout' => 30,
            'root' => '/home/dawul/cdn.tharee.net/profile_avatars',
            'url' => 'https://cdn.tharee.net/profile_avatars',
            'visibility' => 'public',
        ],

        'brokers' => [
            'driver' => 'sftp',
            'host' => 'cdn.tharee.net',
            'username' => 'dawul',
            'privateKey' => env('THAREE_CDN_PRIVATE_KEY'),
            'port' => 22,
            'timeout' => 30,
            'root' => '/home/dawul/cdn.tharee.net/broker_images',
            'url' => 'https://cdn.tharee.net/broker_images',
            'visibility' => 'public',
        ],

        'stocks' => [
            'driver' => 'sftp',
            'host' => 'cdn.tharee.net',
            'username' => 'dawul',
            'privateKey' => env('THAREE_CDN_PRIVATE_KEY'),
            'port' => 22,
            'timeout' => 30,
            'root' => '/home/dawul/cdn.tharee.net/stock_images',
            'url' => 'https://cdn.tharee.net/stock_images',
            'visibility' => 'public',
        ],

        'funds' => [
            'driver' => 'sftp',
            'host' => 'cdn.tharee.net',
            'username' => 'dawul',
            'privateKey' => env('THAREE_CDN_PRIVATE_KEY'),
            'port' => 22,
            'timeout' => 30,
            'root' => '/home/dawul/cdn.tharee.net/funds_images',
            'url' => 'https://cdn.tharee.net/fund_images',
            'visibility' => 'public',
        ],

        'common' => [
            'driver' => 'sftp',
            'host' => 'cdn.tharee.net',
            'username' => 'dawul',
            'privateKey' => env('THAREE_CDN_PRIVATE_KEY'),
            'port' => 22,
            'timeout' => 30,
            'root' => '/home/dawul/cdn.tharee.net/public',
            'url' => 'https://cdn.tharee.net/public',
            'visibility' => 'public',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
