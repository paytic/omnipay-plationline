<?php

namespace ByTIC\Omnipay\PlatiOnline\Message;

use ByTIC\Omnipay\Common\Message\Traits\RedirectHtmlTrait;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class PurchaseResponse
 * @package ByTIC\Omnipay\PlatiOnline\Message
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    use RedirectHtmlTrait {
        getRedirectUrl as getRedirectUrlTrait;
    }

    /**
     * @return array
     */
    public function getRedirectData()
    {
        $data = [
            'env_key' => $this->getDataProperty('env_key'),
            'data' => $this->getDataProperty('data'),
        ];

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function getRedirectUrl()
    {
        $url = $this->getRedirectUrlTrait();
        $lang = $this->getDataProperty('lang', 'ro');
        if ($lang == 'en') {
            $url .= '/'.$lang;
        }

        return $url;
    }
}
