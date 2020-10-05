<?php

namespace ByTIC\Omnipay\PlatiOnline\Tests\Traits;

use ByTIC\Omnipay\PlatiOnline\Gateway;
use ByTIC\Omnipay\PlatiOnline\Tests\AbstractTest;

/**
 * Class HasSecurityParamsTraitTest
 * @package ByTIC\Omnipay\PlatiOnline\Tests\Tests
 */
class HasSecurityParamsTraitTest extends AbstractTest
{
    public function test_getWebsite()
    {
        $gateway = new Gateway();
        self::assertNull($gateway->getWebsite());
        $gateway->setWebsite('Test');
        self::assertSame('Test', $gateway->getWebsite());
    }
}
