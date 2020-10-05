<?php

return [
    'loginId' => getenv('PLATIONLINE_LOGIN_ID'),
    'publicKey' => getenv('PLATIONLINE_PUBLIC_KEY'),
    'website' => getenv('PLATIONLINE_WEBSITE'),
    'initialVector' => getenv('PLATIONLINE_INITIAL_VECTOR'),
    'transactionId' => '5f5b9640e2412a5baa857e57',
    'testMode' => true,
    'amount' => 12.34,
    'card' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'phone' => '0741000111',
        'country' => 'Romania',
        'state' => 'Bucharest',
        'city' => 'Bucharest',
        'address1' => 'NoStreet',
        'email' => 'john.doe@gmail.com',
    ],
];