<?php

namespace Paytic\Omnipay\PlatiOnline\Tests\Message;

use Paytic\Omnipay\PlatiOnline\Message\AuthorizeRequest;
use Paytic\Omnipay\PlatiOnline\Message\AuthorizeResponse;

/**
 * Class AuthorizeResponseTest
 * @package Paytic\Omnipay\PlatiOnline\Tests\Message
 */
class AuthorizeResponseTest extends AbstractResponseTest
{
    public function testSend()
    {
        $data = require TEST_FIXTURE_PATH . '/responses/Authorize/verified.php';
        $response = $this->newResponse(AuthorizeResponse::class, AuthorizeRequest::class, $data);

        self::assertInstanceOf(\SimpleXMLElement::class, $response->getData());

        self::assertEquals(0, $response->getCode());
        self::assertSame('xml verified', $response->getMessage());

        $url = $response->getRedirectUrl();
        self::assertIsString($url);
        self::assertStringContainsString('cc.plationline.ro', $url);
    }
}
