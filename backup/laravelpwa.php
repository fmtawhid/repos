<?php

return [
    'name'     => 'LaravelPWA',
    'manifest' => [
        'name'              => env('APP_NAME', 'Writerap PWA'),
        'short_name'        => 'PWA',
        'start_url'         => env('APP_URL'),
        'background_color'  => '#ffffff',
        'theme_color'       => '#000000',
        'display'           => 'standalone',
        'orientation'       => 'any',
        'status_bar'        => 'black',
        'icons'             => [
            '72x72' => [
                'path'    => env('APP_URL').'/images/icons/icon-72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path'    => env('APP_URL').'/images/icons/icon-96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path'    => env('APP_URL').'/images/icons/icon-128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path'    => env('APP_URL').'/images/icons/icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path'    => env('APP_URL').'/images/icons/icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path'    => env('APP_URL').'/images/icons/icon-192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path'    => env('APP_URL').'/images/icons/icon-384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path'    => env('APP_URL').'/images/icons/icon-512x512.png',
                'purpose' => 'any'
            ],
        ],
        'screenshots' => [
            "src"         => env('APP_URL').'/images/icons/splash-640x1136.png',
            "form_factor" => "wide",
            "label"       => "Writebrap PWA"
        ],
        'splash' => [
            '640x1136'  => '/images/icons/splash-640x1136.png',
            '750x1334'  => '/images/icons/splash-750x1334.png',
            '828x1792'  => '/images/icons/splash-828x1792.png',
            '1125x2436' => '/images/icons/splash-1125x2436.png',
            '1242x2208' => '/images/icons/splash-1242x2208.png',
            '1242x2688' => '/images/icons/splash-1242x2688.png',
            '1536x2048' => '/images/icons/splash-1536x2048.png',
            '1668x2224' => '/images/icons/splash-1668x2224.png',
            '1668x2388' => '/images/icons/splash-1668x2388.png',
            '2048x2732' => '/images/icons/splash-2048x2732.png',
        ],
        'shortcuts' => [
            // [
            //     'name'        => 'Shortcut Link 1',
            //     'description' => 'Shortcut Link 1 Description',
            //     'url'         => env('APP_URL').'',
            //     'icons' => [
            //         "src"     => env('APP_URL').'/images/icons/icon-96x96.png',
            //         "purpose" => "any"
            //     ]
            // ],
            // [
            //     'name'        => 'Shortcut Link 2',
            //     'description' => 'Shortcut Link 2 Description',
            //     'url'         => '/shortcutlink2'
            // ]
        ],
        'custom' => []
    ]
];

// laravel pwa error richer pwa install won't be available on desktop. Please add at least one screenshot with the form_factor set to wide
// https://github.com/silviolleite/laravel-pwa/issues/51
// "screenshots": [
//     {
//       "src": "/images/screenshot1.png",
//       "type": "image/png",
//       "sizes": "540x720",
//       "form_factor": "narrow"
//     },
//     {
//       "src": "/images/screenshot2.jpg",
//       "type": "image/jpg",
//       "sizes": "720x540",
//       "form_factor": "wide"
//     }
// ]