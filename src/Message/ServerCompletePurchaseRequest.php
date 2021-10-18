<?php

namespace Paytic\Omnipay\PlatiOnline\Message;

use Paytic\Omnipay\PlatiOnline\Models\Responses\QueryResponse;
use Paytic\Omnipay\PlatiOnline\Utils\Urls;

/**
 * Class ServerCompletePurchaseRequest
 * @package Paytic\Omnipay\PlatiOnline\Message
 *
 * @method ServerCompletePurchaseResponse send()
 */
class ServerCompletePurchaseRequest extends AbstractRequest
{
    protected $relayMessageKey = 'f_itsn_message';
    protected $cryptMessageKey = 'f_crypt_message';

    use Traits\RelayRequestTrait;
    use Traits\HasSoapRequestTrait;

    /**
     * @return string
     */
    protected function getSoapAction(): string
    {
        return 'query';
    }

    /**
     * @param \SoapClient $soapClient
     * @param array $data
     */
    protected function runTransaction($soapClient, $data)
    {
        /** @var \SimpleXMLElement $notification */
        $notification = $data['notification'];
        $request['f_website'] = (string)$notification->f_login;
        $request['f_order_number'] = (string)$notification->f_order_number;
        $request['x_trans_id'] = (string)$notification->x_trans_id;
        $request['f_action'] = 0;

        $response = $this->runSoapRequest($soapClient, $request, 'po_query');

        $data['notification'] = QueryResponse::fromXml($response);
        return $data;
    }

    protected function getValidationMessageUrl()
    {
        return Urls::$itsnXml;
    }

    protected function getSoapRequestValidationUrl(): string
    {
        return Urls::$queryXml;
    }

    protected function getSoapResponseValidationUrl()
    {
        return Urls::$queryResponseXml;
    }
}
