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
    use \ByTIC\Omnipay\Common\Message\Traits\ParametersTrait;
    use \ByTIC\Omnipay\Common\Message\Traits\HasLanguageRequestTrait;
    use \ByTIC\Omnipay\Common\Message\Traits\SendDataRequestTrait;
}
