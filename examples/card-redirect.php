<?php

require __DIR__ . '/init.php';

$gateway = new \ByTIC\Omnipay\PlatiOnline\Gateway();
$parameters = require TEST_FIXTURE_PATH.'/requests/Purchase/baseRequest.php';

$request = $gateway->purchase($parameters);
$response = $request->send();

// Send the Symfony HttpRedirectResponse
$response->send();
