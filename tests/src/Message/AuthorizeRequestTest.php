<?php

namespace ByTIC\Omnipay\PlatiOnline\Tests\Message;

use ByTIC\Omnipay\PlatiOnline\Message\PurchaseRequest;
use ByTIC\Omnipay\PlatiOnline\Message\PurchaseResponse;
use ByTIC\Omnipay\PlatiOnline\Message\AuthorizeRequest;
use ByTIC\Omnipay\PlatiOnline\Message\AuthorizeResponse;

/**
 * Class AuthorizeRequestTest
 * @package ByTIC\Omnipay\PlatiOnline\Tests\Message
 */
class AuthorizeRequestTest extends AbstractRequestTest
{

    public function testSend()
    {
        $data = require TEST_FIXTURE_PATH.'/requests/Purchase/baseRequest.php';
        $data['lang'] = 'en';
        $request = $this->newRequestWithInitTest(AuthorizeRequest::class, $data);

        /** @var AuthorizeResponse $response */
        $response = $request->send();
        self::assertInstanceOf(AuthorizeResponse::class, $response);

        $data = $response->getData();
        self::assertInstanceOf(\SimpleXMLElement::class, $data);

        $url = $response->getRedirectUrl();
        self::assertIsString($url);

        $client = $this->getHttpClientReal();
        $gatewayResponse = $client->request('GET', $url);
        self::assertSame(200, $gatewayResponse->getStatusCode());
//        self::assertStringEndsWith('mobilpay.ro/en', $gatewayResponse->getU());

        //Validate first Response
        $body = $gatewayResponse->getBody()->__toString();
        self::assertStringContainsString('john.doe@gmail.com', $body);
        self::assertStringContainsString('Numărul comenzii:', $body);
    }

}
