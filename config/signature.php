<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Global Toggle
    |--------------------------------------------------------------------------
    */
    'enabled' => env('SIGNATURE_ENABLED', true),
    'publish_humans_txt' => true,

    /*
    |--------------------------------------------------------------------------
    | Default Branding
    |--------------------------------------------------------------------------
    | This is used if no specific host pattern matches.
    */
    'default' => [
        'name'            => env('SIGNATURE_NAME', 'Developer'),
        'company'         => env('SIGNATURE_COMPANY', 'dot-env-it'),
        'website'         => env('SIGNATURE_URL', 'https://github.com/dot-env-it'),
        'email'           => env('SIGNATURE_EMAIL', ''),
        'header'          => env('SIGNATURE_HEADER', 'powered-by-dot-env-it')`,
        'add_to_header'   => true,
        'show_name'       => true,
        'show_company'    => true,
        'show_website'    => true,
        'show_email'      => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Host Overrides
    |--------------------------------------------------------------------------
    | Great for multi-tenant apps or different staging/dev branding.
    */
    'hosts' => [
        'dev.*' => [
            'header' => 'powered-by-dot-env-it',
            'name'   => 'Dev Environment',
        ],
        '*.example.com' => [
            'header' => 'powered-by-dot-env-it',
            'name'   => 'Dev Environment',
        ],
        'example.com' => [
            'header' => 'powered-by-dot-env-it',
            'name'   => 'Dev Environment',
        ],
    ],
];
