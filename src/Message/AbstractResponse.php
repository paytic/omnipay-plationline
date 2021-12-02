<?php

namespace Paytic\Omnipay\PlatiOnline\Message;

use Paytic\Omnipay\Common\Message\Traits\DataAccessorsTrait;
use Omnipay\Common\Message\AbstractResponse as CommonAbstractResponse;

/**
 * Class Response
 * @package Paytic\Omnipay\PlatiOnline\Message
 *
 * @property \SimpleXMLElement $data
 */
abstract class AbstractResponse extends CommonAbstractResponse
{
    use DataAccessorsTrait;
}
