<?php

namespace ByTIC\Omnipay\PlatiOnline\Traits;

use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;

/**
 * Trait HasSecurityParamsTrait
 * @package ByTIC\Omnipay\PlatiOnline\Traits
 */
trait HasSecurityParamsTrait
{
    protected $aesKey = null;

    /**
     * @param $params
     */
    protected function validateWithSecurityParams(...$params)
    {
        $params[] = 'publicKey';
        $params[] = 'loginId';
        $params[] = 'website';
        $this->validate(...$params);
    }

    /**
     * @return mixed
     */
    public function getPublicKey()
    {
        return $this->getParameter('publicKey');
    }

    /**
     * @param $value
     * @return static
     */
    public function setPublicKey($value)
    {
        return $this->setParameter('publicKey', $value);
    }

    // INFO f_website
    // * if you ARE USING the same PlatiOnline account for multiple websites
    // - go to https://merchants.plationline.ro, in Settings tab, POS/Website button, click Add a new POS/website and add your websites
    // - after we approve your websites, please use Website/POS value for $f_request['f_website']

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->getParameter('website');
    }

    /**
     * @param $value
     * @return static
     */
    public function setWebsite($value)
    {
        return $this->setParameter('website', $value);
    }

    /**
     * @return mixed
     */
    public function getLoginId()
    {
        return $this->getParameter('loginId');
    }

    /**
     * @param $value
     * @return static
     */
    public function setLoginId($value)
    {
        return $this->setParameter('loginId', $value);
    }

    /**
     * @return mixed
     */
    public function getInitialVector()
    {
        return $this->getParameter('initialVector');
    }

    /**
     * @param $value
     * @return static
     */
    public function setInitialVector($value)
    {
        return $this->setParameter('initialVector', $value);
    }

    /**
     * @return false|string|null
     */
    public function getAesKey()
    {
        if ($this->aesKey === null) {
            $this->aesKey = substr(hash('sha256', uniqid(), 0), 0, 32);
        }
        return $this->aesKey;
    }
}
