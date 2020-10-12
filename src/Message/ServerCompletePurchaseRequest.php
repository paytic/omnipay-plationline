<?php

namespace ByTIC\Omnipay\PlatiOnline\Message;

use ByTIC\Omnipay\Common\Library\Signer;
use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use ByTIC\Omnipay\Mobilpay\Models\Request\AbstractRequest as MobilPayAbstractRequest;
use ByTIC\Omnipay\PlatiOnline\Utils\Urls;
use Exception;

/**
 * Class ServerCompletePurchaseRequest
 * @package ByTIC\Omnipay\PlatiOnline\Message
 *
 * @method ServerCompletePurchaseResponse send()
 */
class ServerCompletePurchaseRequest extends AbstractRequest
{
    protected $relayMessageKey = 'f_itsn_message';
    protected $cryptMessageKey = 'f_crypt_message';

    use Traits\RelayRequestTrait;


    protected function getValidationMessageUrl()
    {
        return Urls::$itsnXml;
    }
}
