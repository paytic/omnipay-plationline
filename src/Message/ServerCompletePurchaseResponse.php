<?php

namespace ByTIC\Omnipay\PlatiOnline\Message;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationResponseTrait;
use ByTIC\Omnipay\Mobilpay\Models\Request\Card;
use ByTIC\Omnipay\Mobilpay\Models\Request\Notify;
use DateTime;

/**
 * Class ServerCompletePurchaseResponse
 * @package ByTIC\Omnipay\PlatiOnline\Message
 */
class ServerCompletePurchaseResponse extends AbstractResponse
{
    use Traits\RelayResponseTrait;

    public function send()
    {
        header('Content-type: application/xml');
        echo $this->getContent();
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getNotification()->asXML();
    }
}
