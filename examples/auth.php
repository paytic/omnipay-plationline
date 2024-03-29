<?php

require __DIR__ . '/init.php';

$gateway = new \Paytic\Omnipay\PlatiOnline\Gateway();
$parameters = require TEST_FIXTURE_PATH . '/requests/Purchase/baseRequest.php';

$request = $gateway->authorize($parameters);
$response = $request->send();

var_dump($response->isSuccessful());
var_dump($response->getData());
