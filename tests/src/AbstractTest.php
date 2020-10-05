<?php

namespace ByTIC\Omnipay\PlatiOnline\Tests;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Omnipay\Tests\Traits\HasClientLiveTrait;
use Omnipay\Tests\Traits\HasTestUtilMethods;

/**
 * Class AbstractTest
 */
abstract class AbstractTest extends PHPUnitTestCase
{
    use HasTestUtilMethods;
    use HasClientLiveTrait {
        HasClientLiveTrait::getHttpClientReal insteadof HasTestUtilMethods;
    }

    protected $object;
}
