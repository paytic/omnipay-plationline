<?php

namespace Paytic\Omnipay\PlatiOnline\Tests\Message;

use Paytic\Omnipay\PlatiOnline\Message\AbstractRequest;
use Paytic\Omnipay\PlatiOnline\Tests\AbstractTest;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**AbstractSoapRequestTrait
 * Class AbstractRequestTest
 * @package ByTIC\Omnipay\Mobilpay\Tests\Message
 */
abstract class AbstractRequestTest extends AbstractTest
{
    /**
     * @param string $class
     * @param array $data
     * @return AbstractRequest
     */
    protected function newRequestWithInitTest($class, $data, $httpRequest = null)
    {
        $request = $this->newRequest($class, $httpRequest);
        self::assertInstanceOf($class, $request);
        $request->initialize($data);
        return $request;
    }

    /**
     * @param string $class
     * @return AbstractRequest
     */
    protected function newRequest($class, $httpRequest= null)
    {
        $client = $this->getHttpClient();
        $httpRequest = $httpRequest ? $httpRequest : HttpRequest::createFromGlobals();
        return new $class($client, $httpRequest);
    }
}
