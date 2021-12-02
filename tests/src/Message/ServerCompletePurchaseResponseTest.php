<?php

namespace Paytic\Omnipay\PlatiOnline\Tests\Message;

use Paytic\Omnipay\PlatiOnline\Message\ServerCompletePurchaseRequest;
use Paytic\Omnipay\PlatiOnline\Message\ServerCompletePurchaseResponse;

/**
 * Class AuthorizeResponseTest
 * @package Paytic\Omnipay\PlatiOnline\Tests\Message
 */
class ServerCompletePurchaseResponseTest extends AbstractResponseTest
{
    /**
     * @dataProvider data_success_flags
     */
    public function test_success_flags($data, $isSuccessful, $isPending, $isCancelled)
    {
        $response = $this->newResponse(
            ServerCompletePurchaseResponse::class,
            ServerCompletePurchaseRequest::class,
            $data
        );

        self::assertSame($isSuccessful, $response->isSuccessful());
        self::assertSame($isPending, $response->isPending());
        self::assertSame($isCancelled, $response->isCancelled());
    }

    public function data_success_flags()
    {
        return [
            [
                ['status1' => 2, 'status2' => 1], //data
                true, //$isSuccessful
                false, //$isPending
                false, //$isCancelled
            ],
            [
                ['status1' => 3, 'status2' => 1], //data
                false, //$isSuccessful
                false, //$isPending
                false, //$isCancelled
            ],
            [
                ['status1' => 3, 'status2' => 4], //data
                true, //$isSuccessful
                false, //$isPending
                false, //$isCancelled
            ],
            [
                ['status1' => 6, 'status2' => 1], //data
                false, //$isSuccessful
                false, //$isPending
                true, //$isCancelled
            ],
        ];
    }
}
