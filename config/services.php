<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN','gmon.com.vn'),
        'secret' => env('MAILGUN_SECRET','key-c99a4ea0a18906aec16035a79b6e6784'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '212812479241763',
        'client_secret' => '0194a76b837cb8ad9ce5a14c4d313f2e',
        'redirect' => 'http://gmon.vn/auth/facebook/callback',
    ],

    'google' => [
        'client_id' => '417199133117-sing5evaq5342lub46auitbd4utc3u3q.apps.googleusercontent.com',
        'client_secret' => 'PK2KHvX6JntcZ0G-fsSUgS47',
        'redirect' => 'http://gmon.vn/auth/google/callback',
    ],

];
