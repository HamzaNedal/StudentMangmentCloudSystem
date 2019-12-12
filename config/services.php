<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    'firebase' => [
        'api_key' => 'AIzaSyC6anjgGkdu1ZmOQ3iqubw53ITRF05hdUM', // Only used for JS integration
        'auth_domain' => "projectcloud-243cc.firebaseapp.com", // Only used for JS integration
        'database_url' => "https://projectcloud-243cc.firebaseio.com",
        'secret' => 'secret',
        'storage_bucket' => 'projectcloud-243cc.appspot.com', // Only used for JS integration
    ],

];
