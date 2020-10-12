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
        $stare1 = '<f_response_code>1</f_response_code>';
        $stare1 = '<f_response_code>0</f_response_code>';

        $content = '<?xml version="1.0" encoding="UTF-8" ?>';
        $content .= '<itsn>';
        $content .= '<x_trans_id>' . $this->getTransactionReference() . '</x_trans_id>';
        $content .= '<merchServerStamp>' . date("Y-m-d H:m:s") . '</merchServerStamp>';
        $content .= $stare1;
        $content .= '</itsn>';
        return $content;
    }

    /**
     * @inheritDoc
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getStatus1()
    {
        return (string)$this->getNotification()->status_fin1;
    }

    /**
     * @inheritDoc
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getStatus2()
    {
        return (string)$this->getNotification()->status_fin2;
    }

//    public function isCancelled()
//    {
//        return $this->get;
//    }
}
