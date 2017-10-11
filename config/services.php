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
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
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
        'redirect' => 'http://spa.gmon.vn/auth/facebook/callback',
    ],

    'google' => [
        'client_id' => '417199133117-9c8utpacu1ts1gl16omtqpeklu13a2d2.apps.googleusercontent.com',
        'client_secret' => 'l3Cb0kg1SdAbBy9r2HEU3LLg',
        'redirect' => 'http://spa.gmon.vn/auth/google/callback',
    ],

];
