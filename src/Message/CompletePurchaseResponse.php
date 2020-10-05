<?php

namespace ByTIC\Omnipay\PlatiOnline\Message;

use ByTIC\Omnipay\Common\Message\Traits\HtmlResponses\ConfirmHtmlTrait;

/**
 * Class CompletePurchaseResponse
 * @package ByTIC\Omnipay\PlatiOnline\Message
 */
class CompletePurchaseResponse extends AbstractResponse
{
    use ConfirmHtmlTrait;

    public function isSuccessful()
    {
        return $this->getCode() == '2';
    }

    public function isPending()
    {
        return $this->getCode() == '13';
    }

    public function getMessage()
    {
        return
            'CODE: '. $this->getNotification()->x_response_reason_code
            .' '. $this->getNotification()->x_response_reason_text;
    }

    public function getCode()
    {
        return (string)$this->getNotification()->x_response_code;
    }

    public function getTransactionReference()
    {
        return (string)$this->getNotification()->x_trans_id;
    }

    /**
     * @return \SimpleXMLElement
     */
    protected function getNotification()
    {
        return $this->getDataProperty('notification');
    }
}
