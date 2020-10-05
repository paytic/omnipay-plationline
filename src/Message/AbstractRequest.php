<?php

namespace ByTIC\Omnipay\PlatiOnline\Message;

use ByTIC\Omnipay\Common\Message\Traits\Soap\AbstractSoapRequestTrait;
use ByTIC\Omnipay\PlatiOnline\Utils\Urls;
use Nip\Utility\Xml;
use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;
use phpseclib\Crypt\AES;
use phpseclib\Crypt\RSA;

/**
 * Class AbstractRequest
 * @package ByTIC\Omnipay\PlatiOnline\Message
 */
abstract class AbstractRequest extends CommonAbstractRequest
{
    use \ByTIC\Omnipay\PlatiOnline\Traits\HasSecurityParamsTrait;
    use \ByTIC\Omnipay\Common\Message\Traits\ParametersTrait;
    use \ByTIC\Omnipay\Common\Message\Traits\HasLanguageRequestTrait;
    use \ByTIC\Omnipay\Common\Message\Traits\SendDataRequestTrait;
}
