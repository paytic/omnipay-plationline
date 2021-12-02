<?php

namespace Paytic\Omnipay\PlatiOnline\Message;

use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;

/**
 * Class AbstractRequest
 * @package Paytic\Omnipay\PlatiOnline\Message
 */
abstract class AbstractRequest extends CommonAbstractRequest
{
    use \Paytic\Omnipay\PlatiOnline\Traits\HasSecurityParamsTrait;
    use \Paytic\Omnipay\Common\Message\Traits\ParametersTrait;
    use \Paytic\Omnipay\Common\Message\Traits\HasLanguageRequestTrait;
    use \Paytic\Omnipay\Common\Message\Traits\SendDataRequestTrait;
}
