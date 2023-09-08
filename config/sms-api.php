<?php

return [

    'country_code' => '966', //Country code to be added
    'default' => env('SMS_API_GATEWAY', 'msegat'), //Choose default gateway
//    MSG91 Sample Config
    'msegat' => [
        'method' => 'POST',
        'url' => 'https://www.msegat.com/gw/sendsms.php',
        'params' => [
            'send_to_param_name' => 'numbers',
            'msg_param_name' => 'msg',
            'others' => [
                'apiKey' => env('SMS_API_KEY'),
                'userName' => env('SMS_API_USERNAME'),
                'userSender' => env('SMS_API_SENDER'),
                'msgEncoding' => 'UTF8',
            ],
        ],
        'json' => true,
        'jsonToArray' => false,
        'add_code' => false,
    ],

];
