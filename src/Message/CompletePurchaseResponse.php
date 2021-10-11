<?php

namespace Paytic\Omnipay\PlatiOnline\Message;

use ByTIC\Omnipay\Common\Message\Traits\HtmlResponses\ConfirmHtmlTrait;

/**
 * Class CompletePurchaseResponse
 * @package Paytic\Omnipay\PlatiOnline\Message
 */
class CompletePurchaseResponse extends AbstractResponse
{
    use ConfirmHtmlTrait;
    use Traits\RelayResponseTrait;

    protected function initViewVars()
    {
        $this->getView()->set('message', $this->getMessage());
    }
}
