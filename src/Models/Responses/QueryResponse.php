<?php

namespace Paytic\Omnipay\PlatiOnline\Models\Responses;

use JsonSerializable;
use SimpleXMLElement;

class QueryResponse implements JsonSerializable
{
    /**
     * @var SimpleXMLElement
     */
    protected $data;

    /**
     * @param SimpleXMLElement $data
     */
    public static function fromXml(SimpleXMLElement $data)
    {
        $response = new static();
        $response->data = $data;

        return $response;
    }

    public function getStatus1(): string
    {
        return (string)$this->data->order->tranzaction->status_fin1->code;
    }

    public function getStatus2(): string
    {
        return (string)$this->data->order->tranzaction->status_fin2->code;
    }

    public function getTransactionId(): string
    {
        return (string)$this->data->order->f_order_number;
    }

    public function getTransactionReference(): string
    {
        return (string)$this->data->order->tranzaction->x_trans_id;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->data;
    }
}