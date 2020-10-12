<?php

namespace ByTIC\Omnipay\PlatiOnline\Message\Traits;

use SimpleXMLElement;

/**
 * Trait RelayResponseTrait
 * @package ByTIC\Omnipay\PlatiOnline\Message\Traits
 */
trait RelayResponseTrait
{
    /**
     * @inheritDoc
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function isSuccessful()
    {
        return $this->getCode() == '2';
    }

    /**
     * @inheritDoc
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function isPending()
    {
        return $this->getCode() == '13';
    }

    /**
     * @inheritDoc
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getMessage()
    {
        return
            'CODE: '. $this->getNotification()->x_response_reason_code
            .' '. $this->getNotification()->x_response_reason_text;
    }

    /**
     * @inheritDoc
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getCode()
    {
        return (string)$this->getNotification()->x_response_code;
    }

    /**
     * @inheritDoc
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getTransactionReference()
    {
        return (string)$this->getNotification()->x_trans_id;
    }

    /**
     * @inheritDoc
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getTransactionId()
    {
        return (string)$this->getNotification()->f_order_number;
    }

    /**
     * @return SimpleXMLElement
     */
    protected function getNotification()
    {
        return $this->getDataProperty('notification');
    }
}