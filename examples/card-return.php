<?php

require __DIR__ . '/init.php';

$gateway = new \ByTIC\Omnipay\PlatiOnline\Gateway();
$parameters = [
    'publicKey' => getenv('PlatiOnline_PUBLIC_KEY'),
    'privateKey' => getenv('PlatiOnline_PRIVATE_KEY'),
];

$request = $gateway->completePurchase($parameters);
$response = $request->send();

$response->send();
