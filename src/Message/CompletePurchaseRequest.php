<?php

namespace ByTIC\Omnipay\PlatiOnline\Message;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use ByTIC\Omnipay\PlatiOnline\Utils\Urls;
use Nip\Utility\Str;
use Nip\Utility\Xml;
use phpseclib\Crypt\AES;
use phpseclib\Crypt\RSA;

/**
 * Class CompletePurchaseRequest
 * @package ByTIC\Omnipay\PlatiOnline\Message
 */
class CompletePurchaseRequest extends AbstractRequest
{
    use GatewayNotificationRequestTrait;

    /**
     * @return mixed
     */
    public function isValidNotification()
    {
        return $this->hasPOST('F_Relay_Message', 'F_Crypt_Message');
    }

    /**
     * @return bool|mixed
     */
    protected function parseNotification()
    {
        $this->validate('privateKey');

        $response = $this->decryptResponse(
            $this->httpRequest->request->get('F_Relay_Message'),
            $this->httpRequest->request->get('F_Crypt_Message'),
            Urls::$authResponseXml
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
