<?php

namespace Paytic\Omnipay\PlatiOnline;

use Paytic\Omnipay\PlatiOnline\Message\AuthorizeRequest;
use Paytic\Omnipay\PlatiOnline\Message\AuthorizeResponse;
use Paytic\Omnipay\PlatiOnline\Message\CompletePurchaseRequest;
use Paytic\Omnipay\PlatiOnline\Message\PurchaseRequest;
use Paytic\Omnipay\PlatiOnline\Message\ServerCompletePurchaseRequest;
use Paytic\Omnipay\PlatiOnline\Traits\HasSecurityParamsTrait;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class Gateway
 * @package Paytic\Omnipay\PlatiOnline
 *
 * @method RequestInterface capture(array $options = [])
 * @method RequestInterface completeAuthorize(array $options = [])
 * @method RequestInterface refund(array $options = [])
 * @method RequestInterface void(array $options = [])
 * @method RequestInterface createCard(array $options = [])
 * @method RequestInterface updateCard(array $options = [])
 * @method RequestInterface deleteCard(array $options = [])
 * @method RequestInterface fetchTransaction(array $options = [])
 * @method NotificationInterface acceptNotification(array $options = [])
 */
class Gateway extends AbstractGateway
{
    use HasSecurityParamsTrait;

    public const VERSION = '1.0';

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
        $authorizeRequest = $this->authorize(array_merge($this->getDefaultParameters(), $parameters));

        return $this->createRequest(
            PurchaseRequest::class,
            ['authorizeResponse' => $authorizeRequest->send()]
        );
    }

    /**
     * @inheritdoc
     * //     * @return CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = []): RequestInterface
    {
        return $this->createRequest(
            CompletePurchaseRequest::class,
            array_merge($this->getDefaultParameters(), $parameters)
        );
    }

    /**
     * @inheritdoc
     * @return AuthorizeResponse
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
        return $this->createRequest(
            ServerCompletePurchaseRequest::class,
            array_merge($this->getDefaultParameters(), $parameters)
        );
    }

    // ------------ PARAMETERS ------------ //

    /** @noinspection PhpMissingParentCallCommonInspection
     *
     * {@inheritdoc}
     */
    public function getDefaultParameters()
    {
        return [
            'testMode' => $this->getTestMode(),
            'loginId' => $this->getLoginId(),
            'publicKey' => $this->getPublicKey(),
            'privateKey' => $this->getPrivateKey(),
            'initialVector' => $this->getInitialVector(),
            'initialVectorItsn' => $this->getInitialVectorItsn(),
            'website' => $this->getWebsite(),
            'currency' => 'RON',
            'lang' => 'RO'
        ];
    }

    // ------------ Getter'n'Setters ------------ //
}
