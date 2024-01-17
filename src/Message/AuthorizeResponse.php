<?php

namespace Paytic\Omnipay\PlatiOnline\Message;

/**
 * Class AuthorizeResponse
 * @package Paytic\Omnipay\PlatiOnline\Message
 */
class AuthorizeResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function getRedirectUrl()
    {
        return (string) $this->getDataProperty('po_redirect_url');
    }

    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
        return $this->getCode() != 1;
    }

    /**
     * @inheritDoc
     */
    public function getMessage()
    {
        return (string) $this->getDataProperty('po_error_reason');
    }

    /**
     * @inheritDoc
     */
    public function getCode()
    {
        return (string) $this->getDataProperty('po_error_code');
    }

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return (string) $this->getDataProperty('x_trans_id');
    }
}
