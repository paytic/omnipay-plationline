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
        return (string) $this->data->po_redirect_url;
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
        return (string) $this->data->po_error_reason;
    }

    /**
     * @inheritDoc
     */
    public function getCode()
    {
        return (string) $this->data->po_error_code;
    }

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return (string) $this->data->x_trans_id;
    }
}
