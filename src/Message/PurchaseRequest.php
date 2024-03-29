<?php

namespace Paytic\Omnipay\PlatiOnline\Message;

use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;

/**
 * Class PurchaseRequest
 * @package Paytic\Omnipay\PlatiOnline\Message
 *
 * @method PurchaseResponse send()
 */
class PurchaseRequest extends CommonAbstractRequest
{
    use \Paytic\Omnipay\Common\Message\Traits\ParametersTrait;
    use \Paytic\Omnipay\Common\Message\Traits\HasLanguageRequestTrait;
    use \Paytic\Omnipay\Common\Message\Traits\SendDataRequestTrait;

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return [
            'redirectUrl' => $this->getAuthorizeResponse()->getRedirectUrl()
        ];
    }

    /**
     * @param AuthorizeResponse $response
     */
    public function setAuthorizeResponse($response)
    {
        $this->setParameter('authorizeResponse', $response);
    }

    /**
     * @return AuthorizeResponse
     */
    public function getAuthorizeResponse()
    {
        return $this->getParameter('authorizeResponse');
    }
}
