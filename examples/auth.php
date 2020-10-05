<?php

require __DIR__ . '/init.php';

$gateway = new \ByTIC\Omnipay\PlatiOnline\Gateway();
$parameters = require TEST_FIXTURE_PATH.'/requests/PurchaseRequest/baseRequest.php';

$request = $gateway->authorize($parameters);
$response = $request->send();

var_dump($response->isSuccessful());
var_dump($response->getData());
