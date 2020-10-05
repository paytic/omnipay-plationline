<?php

namespace ByTIC\Omnipay\PlatiOnline\Message;

/**
 * Class AuthorizeResponse
 * @package ByTIC\Omnipay\PlatiOnline\Message
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

}
