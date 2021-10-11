<?php

namespace Paytic\Omnipay\PlatiOnline\Tests\Traits;

use Paytic\Omnipay\PlatiOnline\Gateway;
use Paytic\Omnipay\PlatiOnline\Tests\AbstractTest;

/**
 * Class HasSecurityParamsTraitTest
 * @package Paytic\Omnipay\PlatiOnline\Tests\Tests
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
