<?php

namespace ByTIC\Omnipay\PlatiOnline\Tests\Message;

use ByTIC\Omnipay\PlatiOnline\Message\AbstractRequest;
use ByTIC\Omnipay\PlatiOnline\Tests\AbstractTest;
use Omnipay\Common\Message\AbstractResponse;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class AbstractResponseTest
 * @package ByTIC\Omnipay\Mobilpay\Tests\Message
 */
abstract class AbstractResponseTest extends AbstractTest
{
    /**
     * @param string $class Request Class
     * @param array $data
     * @return AbstractResponse|\Omnipay\Common\Message\ResponseInterface
     */
    protected function newResponse($responseClass, $requestClass, $data = [])
    {
        $client = $this->getHttpClient();
        $request = HttpRequest::createFromGlobals();

        /** @var AbstractRequest $request */
        $request = new $requestClass($client, $request);
        $response = new $responseClass($request, $data);

        return $response;
    }
}
