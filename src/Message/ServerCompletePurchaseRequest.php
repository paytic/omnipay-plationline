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
    use GatewayNotificationRequestTrait;

    /**
     * @inheritdoc
     */
    public function getData()
    {
        try {
            $this->traitGetData();
        } catch (Exception $exception) {
            $this->setDataItem('code', MobilPayAbstractRequest::CONFIRM_ERROR_TYPE_TEMPORARY);
            $this->setDataItem('codeType', $exception->getCode());
            $this->setDataItem('message', $exception->getMessage());
        }

        return $this->getDataArray();
    }

    /**
     * @return mixed
     */
    public function isValidNotification()
    {
        return $this->hasPOST('env_key') && $this->hasPOST('data');
    }

    /**
     * @return bool|mixed
     * @throws Exception
     */
    protected function parseNotification()
    {
        $xml = $this->getDecodedXML();
        $notification = $this->getMobilPayNotify($xml);

        $this->setDataItem('code', $notification->errorCode);
        $this->setDataItem('codeType', $notification->errorCode);
        $this->setDataItem('message', $notification->errorMessage);

        return $notification;
    }

    /**
     * @return string
     */
    public function getDecodedXML()
    {
        $data = $this->getDecodedData();
        $envKey = $this->getDecodedKey();

        $signer = new Signer();
        $signer->setPrivateKey($this->getPrivateKey());

        return $signer->openContentWithRSA($data, $envKey);
    }

    /**
     * @return bool|mixed|string
     * @throws Exception
     */
    protected function getDecodedData()
    {
        if (!$this->hasDataItem('data_decoded')) {
            $data = $this->httpRequest->request->get('data');
            $data = base64_decode($data);
            if ($data === false) {
                throw new Exception(
                    'Failed decoding data',
                    MobilPayAbstractRequest::ERROR_CONFIRM_FAILED_DECODING_DATA
                );
            }
            $this->setDataItem('data_decoded', $data);
        }

        return $this->getDataItem('data_decoded');
    }

    /**
     * @return bool|mixed|string
     * @throws Exception
     */
    protected function getDecodedKey()
    {
        if (!$this->hasDataItem('key_decoded')) {
            $envKey = $this->httpRequest->request->get('env_key');
            $envKey = base64_decode($envKey);
            if ($envKey === false) {
                throw new Exception(
                    'Failed decoding envelope key',
                    MobilPayAbstractRequest::ERROR_CONFIRM_FAILED_DECODING_ENVELOPE_KEY
                );
            }
            $this->setDataItem('key_decoded', $envKey);
        }

        return $this->getDataItem('key_decoded');
    }

    /**
     * @param $xml
     * @return \ByTIC\Omnipay\Mobilpay\Models\Request\Notify
     */
    public function getMobilPayNotify($xml)
    {
        $cardRequest = $this->parseXml($xml);
        $this->setDataItem('cardRequest', $cardRequest);

        return $cardRequest->notifyResponse;
    }

    /**
     * @param $xml
     * @return \ByTIC\Omnipay\Mobilpay\Models\Request\Card
     */
    public function parseXml($xml)
    {
        return MobilPayAbstractRequest::factory($xml);
    }
}
