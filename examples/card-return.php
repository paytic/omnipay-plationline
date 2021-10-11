<?php

require __DIR__ . '/init.php';

$gateway = new \Paytic\Omnipay\PlatiOnline\Gateway();
$gateway->initialize(require TEST_FIXTURE_PATH . '/enviromentParams.php');

$request = $gateway->completePurchase();
$response = $request->send();

$response->send();
