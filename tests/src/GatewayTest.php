<?php

namespace ByTIC\Omnipay\PlatiOnline\Tests;

use ByTIC\Omnipay\PlatiOnline\Gateway;

/**
 * Class HelperTest
 * @package ByTIC\Omnipay\PlatiOnline\Tests
 */
class GatewayTest extends AbstractTest
{
    public function testTestMode()
    {
        $this->assertSame($this->gateway, $this->gateway->setTestMode(false));
        $this->assertSame(false, $this->gateway->getTestMode());

        $this->assertSame($this->gateway, $this->gateway->setTestMode(true));
        $this->assertSame(true, $this->gateway->getTestMode());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->gateway = new Gateway();
    }
}
