<?php

namespace ByTIC\Omnipay\PlatiOnline;

use ByTIC\Omnipay\PlatiOnline\Message\AuthorizeRequest;
use ByTIC\Omnipay\PlatiOnline\Traits\HasSecurityParamsTrait;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class Gateway
 * @package ByTIC\Omnipay\PlatiOnline
 *
 * @method RequestInterface completeAuthorize(array $options = [])
 * @method RequestInterface refund(array $options = [])
 * @method RequestInterface void(array $options = [])
 * @method RequestInterface createCard(array $options = [])
 * @method RequestInterface updateCard(array $options = [])
 * @method RequestInterface deleteCard(array $options = [])
 * @method RequestInterface fetchTransaction(array $options = [])
 * @method NotificationInterface acceptNotification(array $options = array())
 */
class Gateway extends AbstractGateway
{
    use HasSecurityParamsTrait;

    public const VERSION = '1.0';

    /**
     * @var string
     */
    private $prodApiHost = 'https://api.PlatiOnline.com';


    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'PlatiOnline';
    }

    // ------------ REQUESTS ------------ //

    /**
     * @inheritdoc
     * @return PurchaseRequest
     */
    public function purchase(array $parameters = []): RequestInterface
    {
//        return $this->createRequest(
//            PurchaseRequest::class,
//            array_merge($this->getDefaultParameters(), $parameters)
//        );
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     *
     * {@inheritdoc}
     */
    public function getDefaultParameters()
    {
        return [
            'testMode' => true, // Must be the 1st in the list!
            'publicKey' => $this->getLoginId(),
            'privateKey' => $this->getPublicKey(),
            'website' => $this->getWebsite(),
            'currency' => 'RON',
            'apiUrl' => $this->getApiUrl()
        ];
    }

    // ------------ PARAMETERS ------------ //

    /**
     * @param  boolean $value
     * @return $this|AbstractGateway
     */
    public function setTestMode($value)
    {
        $this->parameters->remove('apiUrl');
        $this->parameters->remove('secureUrl');
        return parent::setTestMode($value);
    }

    // ------------ Getter'n'Setters ------------ //

    /**
     * Get live- or testURL.
     */
    public function getApiUrl()
    {
        $defaultUrl = $this->getTestMode() === false
            ? $this->prodApiHost
            : $this->prodApiHost;
        return $this->parameters->get('apiUrl', $defaultUrl);
    }

    /**
     * @inheritdoc
//     * @return CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = []): RequestInterface
    {
//        return $this->createRequest(
//            CompletePurchaseRequest::class,
//            array_merge($this->getDefaultParameters(), $parameters)
//        );
    }

    /**
     * @inheritdoc
     * @return CaptureRequest
     */
    public function authorize(array $parameters = []): RequestInterface
    {
        return $this->createRequest(
            AuthorizeRequest::class,
            array_merge($this->getDefaultParameters(), $parameters)
        );
    }

    /**
     * @inheritdoc
     */
    public function serverCompletePurchase(array $parameters = []): RequestInterface
    {
//        return $this->createRequest(
//            ServerCompletePurchaseRequest::class,
//            array_merge($this->getDefaultParameters(), $parameters)
//        );
    }

    /**
     * @param $value
     * @return $this
     */
    public function setApiUrl($value)
    {
        return $this->setParameter('apiUrl', $value);
    }
}
