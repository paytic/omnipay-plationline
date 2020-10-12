<?php

namespace ByTIC\Omnipay\PlatiOnline\Tests\Message;

use ByTIC\Omnipay\PlatiOnline\Message\ServerCompletePurchaseRequest;
use ByTIC\Omnipay\PlatiOnline\Message\ServerCompletePurchaseResponse;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class CompletePurchaseRequestTest
 * @package ByTIC\Omnipay\PlatiOnline\Tests\Message
 */
class ServerCompletePurchaseRequestTest extends AbstractRequestTest
{
    public function test_isValidNotification()
    {
        $httpRequest = HttpRequest::createFromGlobals();
        $httpRequest->request->add(require TEST_FIXTURE_PATH . '/requests/ServerCompletePurchase/authorised.php');

        /** @var ServerCompletePurchaseRequest $request */
        $request = $this->newRequestWithInitTest(ServerCompletePurchaseRequest::class, [], $httpRequest);

        self::assertTrue($request->isValidNotification());
    }

    public function test_send()
    {
        $httpRequest = HttpRequest::createFromGlobals();
        $httpRequest->request->add(require TEST_FIXTURE_PATH . '/requests/ServerCompletePurchase/authorised.php');
        $data = require TEST_FIXTURE_PATH . '/enviromentParams.php';

        /** @var ServerCompletePurchaseRequest $request */
        $request = $this->newRequestWithInitTest(ServerCompletePurchaseRequest::class, $data, $httpRequest);
        $response = $request->send();

        self::assertInstanceOf(ServerCompletePurchaseResponse::class, $response);

        self::assertFalse($response->isSuccessful());
        self::assertFalse($response->isPending());
        self::assertFalse($response->isCancelled());

        self::assertSame('6917422', $response->getTransactionReference());
        self::assertSame('172315', $response->getTransactionId());
    }
}