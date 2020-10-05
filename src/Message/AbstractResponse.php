<?php

namespace ByTIC\Omnipay\PlatiOnline\Message;

use ByTIC\Omnipay\Common\Message\Traits\DataAccessorsTrait;
use Omnipay\Common\Message\AbstractResponse as CommonAbstractResponse;

/**
 * Class Response
 * @package ByTIC\Omnipay\PlatiOnline\Message
 *
 * @property \SimpleXMLElement $data
 */
abstract class AbstractResponse extends CommonAbstractResponse
{
    use DataAccessorsTrait;

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
