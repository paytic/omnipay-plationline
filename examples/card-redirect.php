<?php

require __DIR__ . '/init.php';

$gateway = new \ByTIC\Omnipay\PlatiOnline\Gateway();
$parameters = [
    'publicKey' => getenv('PlatiOnline_PUBLIC_KEY'),
    'privateKey' => getenv('PlatiOnline_PRIVATE_KEY'),
    'orderId' => 99999,
    'title' => 'My shop title',
    'description' => 'My test transaction',
    'returnUrl' => 'card-return.php?id=99999',
    'amount' => 123.34,
    'currency' => 'ron',
    'card' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@gmail.com',
    ],
];

$request = $gateway->purchase($parameters);
$response = $request->send();

// Send the Symfony HttpRedirectResponse
$response->send();
