<?php
/**
 * Project specific config file.
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Default Email CCs
    |--------------------------------------------------------------------------
    |
    | Some of the emails will go out to a number of admin user.
    |
    */

    'default_email_recipients' => [
        'su@mainframe',
    ],

    /*
    |--------------------------------------------------------------------------
    | Section : Project specific custom config
    |--------------------------------------------------------------------------
    */

    'auto_cleanup_enabled' => false,

    /*
    |--------------------------------------------------------------------------
    | External APIs
    |--------------------------------------------------------------------------
    */

    // Facility registry API details
    'facility_registry' => [
        'url' => env('FACILITY_REGISTRY_URL'),
        'X-Auth-Token' => env('FACILITY_REGISTRY_X_AUTH_TOKEN'),
        'client-id' => env('FACILITY_REGISTRY_CLIENT_ID'),
    ],

];
