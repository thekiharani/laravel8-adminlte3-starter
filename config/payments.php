<?php

return [
    'mpesa' => [
        'api_key' => env('MPESA_API_KEY', ''),
        'api_secret' => env('MPESA_API_SECRET', ''),
        'lmo_passkey' => env('LMO_PASSKEY', ''),
        'lmo_short_code' => env('LMO_SHORTCODE', ''),
        'pb_number' => env('MPESA_PB', ''),
        'initiator_name' => env('INITIATOR_NAME', ''),
        'initiator_sc' => env('INITIATOR_SC', ''),
        'test_msisdn' => env('TEST_MSISDN', ''),
        'stk_callback' => env('STK_CALLBACK', ''),
        'c2b_confirmation' => env('C2B_CONFIRMATION', ''),
        'c2b_validation' => env('C2B_VALIDATION', ''),
    ],

];

