<?php

namespace ByTIC\Omnipay\PlatiOnline\Message;

use ByTIC\Omnipay\Common\Library\Signer;
use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use ByTIC\Omnipay\Mobilpay\Models\Request\AbstractRequest as MobilPayAbstractRequest;
use Exception;

/**
 * Class ServerCompletePurchaseRequest
 * @package ByTIC\Omnipay\PlatiOnline\Message
 *
 * @method ServerCompletePurchaseResponse send()
 */
class ServerCompletePurchaseRequest extends AbstractRequest
{
    use Traits\RelayRequestTrait;
}
