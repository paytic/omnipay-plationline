<?php

namespace ByTIC\Omnipay\PlatiOnline\Tests\Message;

use ByTIC\Omnipay\PlatiOnline\Message\CompletePurchaseRequest;
use ByTIC\Omnipay\PlatiOnline\Message\CompletePurchaseResponse;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class CompletePurchaseRequestTest
 * @package ByTIC\Omnipay\PlatiOnline\Tests\Message
 */
class CompletePurchaseRequestTest extends AbstractRequestTest
{
    public function test_isValidNotification()
    {
        $httpRequest = HttpRequest::createFromGlobals();
        $httpRequest->request->add(require TEST_FIXTURE_PATH . '/requests/CompletePurchase/error39.php');

        /** @var CompletePurchaseRequest $request */
        $request = $this->newRequestWithInitTest(CompletePurchaseRequest::class, [], $httpRequest);

        self::assertTrue($request->isValidNotification());
    }

    public function test_send()
    {
        $httpRequest = HttpRequest::createFromGlobals();
        $httpRequest->request->add(require TEST_FIXTURE_PATH . '/requests/CompletePurchase/error39.php');
        $data = require TEST_FIXTURE_PATH . '/enviromentParams.php';

        /** @var CompletePurchaseRequest $request */
        $request = $this->newRequestWithInitTest(CompletePurchaseRequest::class, $data, $httpRequest);
        $response = $request->send();

        self::assertInstanceOf(CompletePurchaseResponse::class, $response);
        self::assertFalse($response->isSuccessful());
        self::assertSame('6895990', $response->getTransactionReference());
        self::assertSame('CODE: 39 Tipul cardului nu este cunoscut', $response->getMessage());
    }
}