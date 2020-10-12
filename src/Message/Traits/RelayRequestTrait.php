<?php

namespace ByTIC\Omnipay\PlatiOnline\Message\Traits;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use ByTIC\Omnipay\PlatiOnline\Utils\Urls;
use Nip\Utility\Str;
use Nip\Utility\Xml;
use phpseclib\Crypt\AES;
use phpseclib\Crypt\RSA;

/**
 * Trait RelayRequestTrait
 * @package ByTIC\Omnipay\PlatiOnline\Message\Traits
 */
trait RelayRequestTrait
{
    use GatewayNotificationRequestTrait;

    protected function getRelayMessage()
    {
        return $this->httpRequest->request->get($this->relayMessageKey);
    }

    protected function getCryptMessage()
    {
        return $this->httpRequest->request->get($this->cryptMessageKey);
    }

    protected function getValidationMessageUrl()
    {
        return Urls::$authResponseXml;
    }

    /**
     * @return mixed
     */
    public function isValidNotification()
    {
        return $this->hasPOST($this->relayMessageKey, $this->cryptMessageKey);
    }

    /**
     * @return bool|mixed
     */
    protected function parseNotification()
    {
        $this->validate('privateKey');

        $response = $this->decryptResponse(
            $this->getRelayMessage(),
            $this->getCryptMessage(),
            $this->getValidationMessageUrl()
        );

        return $response;
    }

    /**
     * @param $relayMessage
     * @param $cryptMessage
     * @param $validation_url
     * @return mixed
     * @throws \Exception
     */
    private function decryptResponse($relayMessage, $cryptMessage, $validation_url)
    {
        if (empty($relayMessage)) {
            throw new \Exception('Decriptare raspuns - nu se primeste [criptul AES]');
        }
        if (empty($cryptMessage)) {
            throw new \Exception('Decriptare raspuns - nu se primeste [criptul RSA]');
        }

        $rsa = new RSA();
        $rsa->loadKey($this->getPrivateKey());
        $rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);
        $aes_key = $rsa->decrypt(base64_decode($cryptMessage));
        if (empty($aes_key)) {
            throw new \Exception('Nu am putut decripta cheia AES din RSA');
        }

        $aes = new AES();
        $aes->setIV($this->getInitialVectorItsn());
        $aes->setKey($aes_key);
        $response = $aes->decrypt(base64_decode(Str::fromHex($relayMessage)));
        if (empty($response)) {
            throw new \Exception('Nu am putut decripta mesajul din criptul AES');
        }

        Xml::validate($response, $validation_url);
        return simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
    }
}
