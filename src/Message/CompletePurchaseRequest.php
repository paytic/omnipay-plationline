<?php

namespace Paytic\Omnipay\PlatiOnline\Message;

/**
 * Class CompletePurchaseRequest
 * @package Paytic\Omnipay\PlatiOnline\Message
 */
class CompletePurchaseRequest extends AbstractRequest
{
    use Traits\RelayRequestTrait;

    protected $relayMessageKey = 'F_Relay_Message';
    protected $cryptMessageKey = 'F_Crypt_Message';
}
